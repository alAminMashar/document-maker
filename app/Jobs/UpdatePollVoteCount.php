<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Poll;


class UpdatePollVoteCount implements ShouldQueue
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
        $poll = Poll::find($this->poll_id);
        if ($poll) {
            $poll->updateCurrentVotes();
        }else{
            Log::error("Poll not found for ID: " . $this->poll_id);
        }
    }

}
