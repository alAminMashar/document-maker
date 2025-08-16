<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Models\Poll;
use App\Models\Candidate;

class VoteSession implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll, $candidate, $target_votes;

    /**
     * Create a new job instance.
     */
    public function __construct(Poll $poll, Candidate $candidate, $target_votes)
    {
        $this->poll = $poll;
        $this->candidate = $candidate;
        $this->target_votes = $target_votes;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Log::info('Voting data', [
        //     'total_target_at_session'      =>  $this->target_votes,
        // ]);

        $this->dispatchCommands();
    }

    public function dispatchCommands()
    {
        for ($i=0; $i < $this->target_votes; $i++) {
            dispatch(new ExecuteSessionCommand($this->poll, $this->candidate));
            // ->delay(now()->addMinutes($this->generateRandomInt()));
        }
    }

    public function sessionIntervalMinutes()
    {
        $duration_in_mins = $this->poll['duration']?? 0 * 60;
        $session_intervals = $duration_in_mins/$this->number_of_sessions;

        return $session_intervals;
    }

    /**
     * Generate a random integer between a given range.
     *
     * @param int $min
     * @param int $max
     * @return int
     * @throws Exception
     */
    function generateRandomInt(): int
    {
        $min = 1;
        $max = $this->target_votes;

        if ($min > $max) {
            [$min, $max] = [$max, $min]; // Swap values
        }

        return random_int($min, $max);
    }
}
