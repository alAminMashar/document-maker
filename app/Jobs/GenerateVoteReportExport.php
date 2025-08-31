<?php

namespace App\Jobs;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ExportVoteReport;
use App\Models\DocumentType;
use App\Jobs\CreateDocument;
use Str;

class GenerateVoteReportExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll_id, $description;

    /**
     * Create a new job instance.
     */
    public function __construct($poll_id, $description)
    {
        $this->poll_id = $poll_id;
        $this->description = $description;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ini_set('memory_limit', '1024M');
        $description = "$this->description Generated On " . now()->format('D M Y H-i-s');
        $file_name = "$description.xlsx";

        $export_task = new ExportVoteReport($this->poll_id);

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
            $this->poll_id,
            "App\Models\Poll",
            $this->checkDocumentType('Poll Report'),
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
