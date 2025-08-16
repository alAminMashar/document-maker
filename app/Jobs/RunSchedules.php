<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Models\Voter;
use App\Models\Vote;
use App\Models\Poll;
use App\Models\Candidate;

class RunSchedules implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll, $candidates, $poll_votes_target, $number_of_sessions;

    /**
     * Create a new job instance.
     */
    public function __construct(Poll $poll)
    {
        $this->poll = $poll;
        $this->poll_votes_target = $this->setVoteTargets();
        $this->number_of_sessions = $this->setNumberOfSessions();
        $this->candidates = Candidate::orderBy('name','ASC')
        ->where('active',true)
        ->get();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->scheduleCandidateSessions();
    }

    public function scheduleCandidateSessions()
    {
        foreach($this->candidates as $candidate)
        {
            //get vote target
            $candidate_target_votes = $this->getCandidateTarget($candidate);

            Log::info('Voting data', [
                'poll_id' => $this->poll['title'],
                'candidate' => $candidate['name'],
                'total_target'  =>  $this->poll_votes_target,
                'candidate_target'  => $candidate_target_votes,
                'sessions'  =>  $this->number_of_sessions,
            ]);

            $sessions = min($candidate_target_votes,$this->number_of_sessions);

            dispatch(new SetupSessions($this->poll, $candidate, $candidate_target_votes, $sessions));

        }
    }

    public function setVoteTargets()
    {
        return $this->poll['target_votes'];
    }

    public function setNumberOfSessions()
    {
        $number_of_sessions = 0;
        if($this->poll_votes_target > 0){
            $number_of_sessions = $this->poll_votes_target / $this->poll->duration;
        }

        return $number_of_sessions;
    }

    public function getCandidateTarget(Candidate $candidate)
    {
        //Get percentage from candidate's multiplier
        $candidate_multiplier = $candidate['multiplier'];

        //As perc
        $candidate_multiplier = $candidate_multiplier/100;

        //Total Votes Candidate Should Get
        $candidate_target = $this->poll_votes_target * $candidate_multiplier;

        return $candidate_target;
    }
}
