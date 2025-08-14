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

class RecordVote implements ShouldQueue
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
        $votes_target = $this->poll['votes_target'];
        $current_votes = $this->poll->votes->count();
        
        $remaining_target = $votes_target - $current_votes;

        if($remaining_target > 0){
            $available_slots = $remaining_target/ $this->poll->duration;
            
        }

    }
}
