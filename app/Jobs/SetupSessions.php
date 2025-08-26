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
use Throwable;

class SetupSessions implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll;
    public $candidates;
    public $targetVotes;

    /**
     * Max votes per session job
     */
    protected int $chunkSize = 100;

    public function __construct(Poll $poll, $candidates, int $targetVotes)
    {
        $this->poll = $poll;
        $this->candidates = $candidates;
        $this->targetVotes = $targetVotes;
    }

    public function handle(): void
    {

        $votePool = [];

        foreach ($this->candidates as $candidate) {
            // Convert percentage targets into actual votes
            $target = $candidate->multiplier > 0
                ? intval(($candidate->multiplier / 100) * $this->targetVotes)
                : intval(1);

            // Add candidate ID to pool repeated by target count
            $votePool = array_merge(
                $votePool,
                array_fill(0, $target, $candidate->id)
            );
        }

        // Shuffle to randomize votes across candidates
        shuffle($votePool);

        // Break into smaller sessions
        $chunks = array_chunk($votePool, $this->chunkSize);

        // Create a job for each chunk
        $jobs = collect($chunks)->map(
            fn ($chunk) => new ExecuteSessionCommand($this->poll->id, $chunk)
        );

        // Dispatch as a batch
        Bus::batch($jobs)
            ->then(fn (Batch $batch) => \Log::info("SetupSessions batch {$batch->id} completed"))
            ->catch(fn (Batch $batch, Throwable $e) => \Log::error("SetupSessions batch {$batch->id} failed", ['error' => $e->getMessage()]))
            ->finally(fn (Batch $batch) => \Log::info("SetupSessions batch {$batch->id} finished"))
            ->onQueue('sessions')
            ->dispatch();
    }
}
