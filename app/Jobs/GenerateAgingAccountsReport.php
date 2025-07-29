<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ExportAgingAccountReport;
use App\Models\DocumentType;
use App\Models\FinancialPeriod as Period;
use Str;

class GenerateAgingAccountsReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user, $report_description, $filter_array, $period;

    /**
     * Create a new job instance.
     */
    public function __construct(Period $period, $user, $report_description, $filter_array)
    {
        $this->period = $period;
        $this->user = $user;
        $this->filter_array = $filter_array;
        $this->report_description = Str::limit($report_description,100,'...');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $description = config('app.name')." Receivables Ageing Report $this->report_description Generated On ".date('D M Y H-i-s');
        $file_name = $description.".xlsx";

        $export_task = new ExportAgingAccountReport($this->filter_array);

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
            $this->period['id'],
            "App\Models\FinancialPeriod",
            115,
            1,
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            '',
            $file_name,
        );

        //Ensure this document type Id exists
        $this->checkDocumentType(115, 'Receivables Ageing Report');
        return $create_document_task;

    }

    private function checkDocumentType($id, $title)
    {
        if(!DocumentType::find($id)){
            DocumentType::create(['name' =>  $title, 'description' => $title]);
        }
    }
}
