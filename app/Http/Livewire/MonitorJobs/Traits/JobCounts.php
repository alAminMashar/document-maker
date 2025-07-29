<?php

namespace App\Http\Livewire\MonitorJobs\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

trait JobCounts
{

    public $pending_job_count, $failed_job_count, $running_job_count;

    public function loadCounts()
    {
        // Fetch pending jobs
        $this->pending_job_count = DB::table('jobs')->count();

        // Fetch failed jobs
        $this->failed_job_count = DB::table('failed_jobs')->count();

        // Running jobs: Estimate based on recent job execution timestamps (if using job events/logging)
        $this->running_job_count = Queue::size(); // Alternative: track active jobs using custom logic
    }
}
