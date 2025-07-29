<?php

namespace App\Http\Livewire\MonitorJobs\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

trait FailedJobs
{
    public $failed_jobs;
    public $expandedJobId = null;

    public function loadFailedJobs()
    {
        $this->failed_jobs = DB::table('failed_jobs')
        ->get()
        ->map(function ($job) {
            $payload = json_decode($job->payload, true);
            return [
                'id' => $job->id,
                'uuid' => $job->uuid,
                'queue' => $job->queue,
                'failed_at' => $job->failed_at,
                'displayName' => $payload['displayName'] ?? 'Unknown Job',
                'exception' => $job->exception,
                'data' => $payload['data'] ?? [],
            ];
        })->take(config('app.paginate'));;
    }

    public function toggleDetails($jobId)
    {
        $this->expandedJobId = $this->expandedJobId === $jobId ? null : $jobId;
    }

    public function retryJob($uuid)
    {
        try {
            Artisan::call("queue:retry {$uuid}");
            $this->loadFailedJobs(); // Refresh the table
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>   "All failed jobs in queue will be retried."
            ]);
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Ooops! Something went wrong!"
            ]);
        }
    }

    public function retryAll()
    {
        try {
            Artisan::call("queue:retry all");
            $this->loadFailedJobs(); // Refresh the table
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>   "All failed jobs in queue will be retried."
            ]);
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Ooops! Something went wrong!"
            ]);
        }
    }

    public function flushQueue()
    {
        try {
            Artisan::call("queue:flush");
            $this->loadFailedJobs(); // Refresh the table
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>   "All failed jobs in queue will be cleared."
            ]);
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Ooops! Something went wrong!"
            ]);
        }
    }

}
