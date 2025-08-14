<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Voter;
use App\Models\Vote;
use App\Models\Poll;
use App\Models\Candidate;

class RunSchedules implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll, $candidates;

    /**
     * Create a new job instance.
     */
    public function __construct(Poll $poll)
    {
        $this->poll = $poll;
        $this->candidates = Candidate::orderBy('name','ASC')->get();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $votes_target = $this->poll['votes_target'];
        $current_votes = $this->poll->votes->count();
        
        $remaining_target = $votes_target - $current_votes;

        if($remaining_target > 0){
            $available_slots = $remaining_target / $this->poll->duration;
            
        }



    }
}
