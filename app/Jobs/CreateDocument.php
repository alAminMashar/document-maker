<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use romanzipp\QueueMonitor\Traits\IsMonitored;
// use IsMonitored;

use App\Models\Document;

class CreateDocument implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    // use IsMonitored;

    public $timeout = 3300;

    private $slug, $description, $documentable_id, $documentable_type, $document_type_id, $original_received, $mime_type, $size, $file_name;

    /**
     * Create a new job instance.
     */
    public function __construct($slug, $description, $documentable_id, $documentable_type, $document_type_id, $original_received, $mime_type, $size, $file_name)
    {
        $this->slug                 =   $slug;
        $this->description          =   $description;
        $this->documentable_id      =   $documentable_id;
        $this->documentable_type    =   $documentable_type;
        $this->document_type_id     =   $document_type_id;
        $this->original_received    =   $original_received;
        $this->mime_type            =   $mime_type;
        $this->size                 =   $size;
        $this->file_name            =   $file_name;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Document::upload(
            $this->slug,
            $this->documentable_id,
            $this->documentable_type,
            $this->document_type_id,
            $this->original_received,
            $this->mime_type,
            $this->size,
            $this->file_name,
            $this->description,
        );

    }

}
