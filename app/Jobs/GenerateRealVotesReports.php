<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use App\Models\Poll;
use App\Models\Voter;
use App\Models\VoteReport;

class GenerateRealVotesReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $votes, $poll_id;

    public $timeout = 3300;

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

        $voters_query = Voter::query()
        ->where('name','<>','Auto Voter')
        ->orWhere('ip_address','<>','172.0.0.1')
        ->orWhere('ip_address','<>','192.0.0.1')
        ->orWhere('device','<>','Bot')
        ->orWhere('browser','<>','0')
        ->orWhere('device','<>','0')
        ->orWhere('browser','<>','192.0.0.1');

        $voters = $voters_query->whereHas('votes',function($query){
            $query->where('poll_id',$this->poll_id);
        });

        foreach($voters->cursor() as $voter)
        {
            $vote = $voter->votes()->first();
            if($vote && !$vote->has('report')){
                dispatch(new GenerateVoteReport($vote));
            }
        }

    }


    public function chainJobs()
    {
        $jobs_array  = [];
        foreach($votes as $vote)
        {
            $jobs_array[] = new GenerateVoteReport($vote);
        }

        Bus::chain($jobs)->dispatch();
    }
}
