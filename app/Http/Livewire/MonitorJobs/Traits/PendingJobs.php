<?php

namespace App\Http\Livewire\MonitorJobs\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

trait PendingJobs
{
    public $pending_jobs;

    public function loadPendingJobs()
    {
        $this->pending_jobs = DB::table('jobs')->get()->map(function ($job) {
        $payload = json_decode($job->payload, true);
            return [
                'id' => $job->id,
                'queue' => $job->queue,
                'attempts' => $job->attempts,
                'uuid' => $payload['uuid'] ?? null,
                'displayName' => $payload['displayName'] ?? 'Unknown Job',
                'job' => $payload['job'] ?? null,
                'data' => $payload['data'] ?? [],
            ];
        })->take(config('app.paginate'));
    }
}
