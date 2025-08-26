<?php

namespace App\Jobs;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ExportVoterReport;
use App\Models\DocumentType;
use App\Models\FinancialPeriod as Period;
use App\Models\User;
use App\Models\Voter;
use Str;

class GenerateVoterReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user, $report_description, $filter_array, $period;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, $report_description, $filter_array)
    {
        $this->user = $user;
        $this->filter_array = $filter_array;
        $this->report_description = Str::limit($report_description,100,'...');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->generateJobs();
    }

    public function generateJobs(){
        $totalVoters = Voter::whereHas('votes', function($q){
            $q->where('poll_id','=',$this->filter_array['poll_id']);
        })->count();

        // Define your batch size
        $batchSize = 500;

        // Get the array of ID ranges
        $idRanges = $this->getVoterIdRanges($batchSize, $totalVoters);

        // Loop through each range and perform an action
        foreach ($idRanges as $range) {
            $this->makeBatches($range);
        }
    }

    function getVoterIdRanges(int $batchSize = 500, int $totalVoters): array
    {
        $ranges = [];
        $totalBatches = ceil($totalVoters / $batchSize);

        for ($i = 0; $i < $totalBatches; $i++) {
            $startId = ($i * $batchSize) + 1;
            $endId = min(($i + 1) * $batchSize, $totalVoters);
            $ranges[] = ['start_id' => $startId, 'end_id' => $endId];
        }

        return $ranges;
    }

    public function makeBatches($range)
    {
        $description = date('D M Y H-i-s')." - Voter Report $this->report_description. Voters from ".$range['start_id']." to ".$range['end_id'];
        $file_name = $description.".xlsx";

        $export_task = new ExportVoterReport($this->filter_array, $range['start_id'], $range['end_id']);

        ($export_task->store($file_name))->chain([
            //chain a job to process after the queue proccess has finished
            $this->createDocTask($description, $file_name),
        ]);
    }

    private function createDocTask($description, $file_name)
    {
        /*------------------------------------------------------------------------------
        # Required Document Create Variables
        # $slug, $description, $documentable_id, $documentable_type, $document_type_id,
        # $original_received, $mime_type, $size, $file_name
        -------------------------------------------------------------------------------*/
        $create_document_task = new CreateDocument(
            $description,
            $description,
            $this->user['id'],
            "App\Models\User",
            $this->checkDocumentType('Voter Report'),
            1,
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            '',
            $file_name,
        );

        return $create_document_task;

    }

    private function checkDocumentType($title)
    {
        $type = DocumentType::where('name','like','%'.$title.'%')->first();
        if($type == null){
            $type = DocumentType::create(['name' =>  $title, 'description' => $title]);
        }
        return $type->id;
    }
}
