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

class ExecuteSessionCommand implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll, $candidate;

    /**
     * Create a new job instance.
     */
    public function __construct(Poll $poll, Candidate $candidate)
    {
        $this->poll = $poll;
        $this->candidate = $candidate;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->createVote();
    }

    public function createVote()
    {
        Vote::create([
            'poll_id'       =>  $this->poll['id'],
            'candidate_id'  =>  $this->candidate['id'],
            'voter_id'      =>  $this->getVoterId(),
        ]);
    }

    public function getVoterId()
    {
        $voter = Voter::create([
            'device'    =>  'linux',
            'platform'  =>  'Browser',
        ]);

        return $voter->id;
    }
}
