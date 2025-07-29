<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Exports\ChangeReportExport;
use App\Models\DocumentType;

class GenerateChangeReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user, $change_type, $start_date, $end_date, $search_key, $active;

    public $timeout = 3300;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $change_type, $start_date, $end_date, $search_key, $active)
    {
        ini_set('max_execution_time', 3600); // 3600 seconds = 60 minutes
        set_time_limit(3600);
        $this->user = $user;
        $this->change_type = $change_type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->search_key = $search_key;
        $this->active = $active;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        //Check or create Doc type
        $this->checkDocumentType(19, 'System Changes Report');

        $user = $this->user;
        $change_type = $this->change_type;
        $start_date = $this->start_date;
        $end_date = $this->end_date;
        $search_key = $this->search_key;
        $active = $this->active;

        $app_name = config('app.name');
        $description = date('Y M d H i s')." System Changes Report for the Period Starting $start_date to $end_date";
        $file_name = $description.".xlsx";

        //Create Document After Generating Export.
        $slug   =   $description;
        $description    =   $description;
        $documentable_id    =   $user['id'];
        $documentable_type  =   "App\Models\User";
        $document_type_id   =   19;
        $original_received  =   1;
        $mime_type  =   "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
        $size   =   '';
        $file_name  =   $file_name;

        $create_document_task = new CreateDocument($slug, $description, $documentable_id,$documentable_type,$document_type_id, $original_received, $mime_type, $size, $file_name);

        $excel_export_task = new ChangeReportExport($change_type, $start_date, $end_date, $search_key, $active);
        ($excel_export_task->store($file_name))->chain([
            //chain a job to process after the queue proccess has finished
            $create_document_task,
        ]);

    }

    public function checkDocumentType($id, $title)
    {

        $type = DocumentType::find($id);

        if(!$type){
            $type = DocumentType::create([
                'id'    =>  $id,
                'name'  =>  $title,
                'description'   =>  $title,
            ]);
        }

        return true;

    }

}
