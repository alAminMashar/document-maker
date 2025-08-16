<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Models\Candidate;
use App\Models\Poll;
use App\Models\Voter;
use App\Models\Vote;

class SetupSessions implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll, $candidate, $votes_target, $number_of_sessions;

    /**
     * Create a new job instance.
     */
    public function __construct(Poll $poll, Candidate $candidate, $votes_target, $number_of_sessions)
    {
        $this->poll = $poll;
        $this->candidate = $candidate;
        $this->votes_target = $votes_target;
        $this->number_of_sessions = $number_of_sessions;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->dispatchSessions();
    }

    public function dispatchSessions()
    {

        for ($i=0; $i < $this->number_of_sessions; $i++) {
            $this->setupSession();
        }
    }

    public function setupSession()
    {
        $session_target = ceil($this->votes_target/ $this->number_of_sessions);
        $session_intervals = $this->sessionIntervalMinutes();
        //dispatch session with delay
        dispatch(
            new VoteSession($this->poll, $this->candidate, $session_target)
        )
        ->delay(now()->addMinutes($session_intervals));
    }

    public function sessionIntervalMinutes()
    {
        $duration_in_mins = $this->poll['duration']?? 0 * 60;
        $session_intervals = $duration_in_mins/$this->number_of_sessions;
        // Log::info('Voting data', [
        //     'session_intervals'      =>  $session_intervals,
        // ]);
        return ceil($session_intervals);
    }
}
