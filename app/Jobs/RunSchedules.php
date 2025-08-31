<?php

namespace App\Jobs;

use App\Models\Poll;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use App\Models\Candidate;
use Throwable;

class RunSchedules implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll;
    public $totalVotes;
    public $sessions;

    public function __construct(Poll $poll, int $totalVotes, int $sessions = 5)
    {
        $this->poll = $poll;
        $this->totalVotes = $totalVotes;
        $this->sessions = $sessions;
    }

    public function handle(): void
    {
        $candidates = Candidate::whereActive(true)->get();
        $votesPerSession = (int) ceil($this->totalVotes / $this->sessions);

        $jobs = [];
        for ($i = 0; $i < $this->sessions; $i++) {
            $jobs[] = new SetupSessions($this->poll, $candidates, $votesPerSession);
        }

        Bus::batch($jobs)
        ->then(fn (Batch $batch) => \Log::info("RunSchedules batch {$batch->id} completed"))
        ->catch(fn (Batch $batch, Throwable $e) => \Log::error("RunSchedules batch {$batch->id} failed", ['error' => $e->getMessage()]))
        ->finally(fn (Batch $batch) => \Log::info("RunSchedules batch {$batch->id} finished"))
        ->onQueue('schedules')
        ->dispatch();
    }
}
