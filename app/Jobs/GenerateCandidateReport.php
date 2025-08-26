<?php

namespace App\Jobs;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ExportCandidateReport;
use App\Models\DocumentType;
use Str;
use App\Jobs\CreateDocument; // Add this line

class GenerateCandidateReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_id, $report_description, $filter_array;

    /**
     * Create a new job instance.
     */
    public function __construct($user_id, $report_description, $filter_array)
    {
        $this->user_id = $user_id;
        $this->report_description = Str::limit($report_description, 100, '...');
        $this->filter_array = $filter_array;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ini_set('memory_limit', '1024M');
        $description = config('app.name') . " Candidate Report $this->report_description Generated On " . now()->format('D M Y H-i-s');
        $file_name = "$description.xlsx";

        $export_task = new ExportCandidateReport($this->filter_array);

        ($export_task->store($file_name))->chain([
            //chain a job to process after the queue proccess has finished
            $this->createDocTask($description, $file_name),
        ]);
    }

    /**
     * Create a new CreateDocument job instance.
     *
     * @param string $description
     * @param string $file_name
     * @return CreateDocument
     */
    private function createDocTask($description, $file_name)
    {
        $create_document_task = new CreateDocument(
            $description,
            $description,
            $this->user_id,
            "App\Models\User",
            $this->checkDocumentType('Candidate Report'),
            1,
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            '',
            $file_name,
        );

        return $create_document_task;
    }

    private function checkDocumentType($title)
    {
        $type = DocumentType::where('name', 'like', '%' . $title . '%')->first();
        if ($type == null) {
            $type = DocumentType::create(['name' => $title, 'description' => $title]);
        }
        return $type->id ?? 1;
    }
}
