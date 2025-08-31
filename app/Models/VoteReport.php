<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class VoteReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'vote_id',
        'poll_id',
        'candidate_name',
        'poll_title',
        'voter_location',
        'time_cast',
        'browser',
        'ip_address',
        'country',
        'city',
        'user_agent',
        'device',
        'platform',
    ];

    /**
     * Get the Vote that owns the VoteReport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Vote(): BelongsTo
    {
        return $this->belongsTo(Vote::class, 'vote_id', 'id');
    }

}
