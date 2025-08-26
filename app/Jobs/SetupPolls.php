<?php

namespace App\Jobs;

use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Throwable;
use App\Models\Poll;
use App\Models\Candidate;

class SetupPolls implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll_id;

    public function __construct(int $poll_id)
    {
        $this->poll_id = $poll_id;
    }

    public function handle(): void
    {
        $poll = Poll::find($this->poll_id);
        $candidates = Candidate::whereActive(true)->get();

        if (!$poll || !$candidates->count()) {
            \Log::warning("SetupPolls: Poll {$this->poll_id} not found or has no candidates");
            return;
        }

        $jobs = [];
        foreach ($candidates as $candidate) {

            $targetVotes = $poll->target_votes * ($candidate['multiplier']/100);

            $jobs[] = new SetupSessions(
                $poll->id,
                $candidate->id,
                $targetVotes,
                $poll->starting_at,
                $poll->ending_at
            );
        }

        if (!empty($jobs)) {
            Bus::batch($jobs)
                ->then(fn (Batch $batch) => \Log::info("SetupPolls batch {$batch->id} completed"))
                ->catch(fn (Batch $batch, Throwable $e) => \Log::error("SetupPolls batch {$batch->id} failed", ['error' => $e->getMessage()]))
                ->finally(fn (Batch $batch) => \Log::info("SetupPolls batch {$batch->id} finished"))
                ->onQueue('sessions')
                ->dispatch();
        }
    }
}
