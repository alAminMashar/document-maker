<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class DispatchVoteReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll_id, $description;

    public $timeout = 3300;

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
        Bus::chain([
            new GenerateRealVotesReports($this->poll_id),
            new GenerateVoteReportExport($this->poll_id, $this->description),
        ])->dispatch();
    }
}
