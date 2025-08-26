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
use App\Models\Poll;

class UpdateAllCandidates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $poll_id;

    /**
     * Create a new job instance.
     */
    public function __construct($poll_id)
    {
        $this->poll_id = $poll_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $candidate_jobs = $this->makeJobs();
        Bus::chain($candidate_jobs)->dispatch();
    }

    public function makeJobs()
    {
        $jobs_array = [];
        $poll = Poll::find($this->poll_id);

        if($poll){
            //Update the Poll too
            array_push($jobs_array, new UpdatePollVoteCount($poll->id));
            //Find all candidates from the poll.
            $candidates = $poll->candidates()->get();
            foreach($candidates as $candidate){
                array_push($jobs_array, new UpdateCandidateStats($candidate->id));
            }

            return $jobs_array;
        }else{
            Log::error("Poll not found for ID: " . $this->poll_id);
        }
    }
}
