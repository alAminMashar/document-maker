<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Vote;
use App\Models\VoteReport;

class GenerateVoteReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $vote;

    public $timeout = 3300;

    /**
     * Create a new job instance.
     */
    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $vote = $this->vote;
        VoteReport::create([
            'vote_id'           =>  $vote->id,
            'poll_id'           =>  $vote->poll->id,
            'candidate_name'    =>  $vote->candidate->name,
            'poll_title'        =>  $vote->poll->title,
            'time_cast'         =>  $vote->created_at,
            'voter_location'    =>  $vote->voter->country,
            'browser'           =>  $vote->voter->browser,
            'ip_address'        =>  $vote->voter->ip_address,
            'country'           =>  $vote->voter->country,
            'city'              =>  $vote->voter->city,
            'user_agent'        =>  $vote->voter->user_agent,
            'device'            =>  $vote->voter->device,
            'platform'          =>  $vote->voter->platform,
        ]);
    }
}
