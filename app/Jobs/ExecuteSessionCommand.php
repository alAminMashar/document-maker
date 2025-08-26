<?php

namespace App\Jobs;

use App\Models\Poll;
use App\Models\Vote;
use App\Models\Voter;
use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExecuteSessionCommand implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    protected int $pollId;
    protected array $candidateIds;

    /**
     * @param int $pollId
     * @param array $candidateIds  Array of candidate IDs to vote for
     */
    public function __construct(int $pollId, array $candidateIds)
    {
        $this->pollId = $pollId;
        $this->candidateIds = $candidateIds;
    }

    public function handle(): void
    {
        foreach ($this->candidateIds as $candidateId) {
            // ✅ Pick a random voter if exists, else create one
            // $voter = Voter::inRandomOrder()->first() ?? Voter::factory()->create();
            // $voter =  Voter::factory()->create();

            Vote::create([
                'poll_id'      => $this->pollId,
                'candidate_id' => $candidateId,
                'voter_id'     => $this->getVoterId(),
            ]);

            // \Log::info("Vote cast for candidate {$candidateId} by voter {$voter->id}");
        }
    }

    public function getVoterId(): int
    {
        $voter = Voter::where('name','Auto Voter')->first();

        if($voter){
            return $voter->id;
        }

        $voter = Voter::create([
            'name' => 'Auto Voter',
            'ip_address' => '192.0.0.1',
            'referer'   => config('app.name'),

        ]);

        return $voter->id;
    }
}
