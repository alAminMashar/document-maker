<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Candidate;
use App\Models\Poll;
use App\Models\Voter;
use App\Models\Vote;

class RunVotes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll, $candidate, $votes_target;

    /**
     * Create a new job instance.
     */
    public function __construct(Poll $poll, Candidate $candidat, $votes_target)
    {
        $this->poll = $poll;
        $this->candidate = $candidate;
        $this->votes_target = $votes_target;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
    }

    public function makeVotes()
    {
        for ($i=0; $i < $this->votes_target; $i++) { 
            
        }
    }

    public function getVoter()
    {
        return $voter = Voter::create([
            'device'    =>  'linux',
            'platform'  =>  'Browser',
        ]);
    }
}
