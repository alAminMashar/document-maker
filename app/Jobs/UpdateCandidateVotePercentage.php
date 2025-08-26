<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Candidate;

class UpdateCandidateVotePercentage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $candidate;

    /**
     * Create a new job instance.
     */
    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $candidate = $this->candidate;
        $total_poll_votes = $candidate->poll->current_votes;
        $candidate_votes = $candidate->vote_count;

        if ($total_poll_votes == 0) {
            $percentage = 0;
        } else {
            $percentage = ($candidate_votes / $total_poll_votes) * 100;
        }

        $this->candidate->update([
            'vote_percentage' => $percentage,
        ]);
    }

}
