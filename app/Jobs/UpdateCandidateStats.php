<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use App\Models\Candidate;

class UpdateCandidateStats implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $candidate;

    /**
     * Create a new job instance.
     */
    public function __construct($candidateId)
    {
        $this->candidate = Candidate::find($candidateId);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //Chain updateCandidateVoteCount and updateCandidateVotePercentage
        if ($this->candidate) {
            Bus::chain([
                new UpdateCandidateVoteCount($this->candidate),
                new UpdateCandidateVotePercentage($this->candidate),
            ])->dispatch();
        }else{
            Log::error("Candidate not found for ID: " . $this->candidateId);
        }
    }
}
