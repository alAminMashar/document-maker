<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{

    use HasFactory;

    protected $table = 'voters';

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'browser',
        'ip_address',
        'country',
        'city',
        'user_agent',
        'device',
        'platform',
        'referer',
        'cookie_value',
    ];

    /**
     * Get the last candidate the voter voted for
     *
     * @return string
     */
    public function lastVotedFor(): string
    {
        $vote = $this->votes()
            ->latest('created_at')
            ->with('candidate:id,name,title') // eager load only required fields
            ->first();

        return $vote
            ? "({$vote->candidate->title}) {$vote->candidate->name}"
            : 'No Votes Yet';
    }

    /**
     * Get all of the candidates for the Voter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function candidates(): HasManyThrough
    {
        return $this->hasManyThrough(
            Candidate::class,   // final model
            Vote::class,    // intermediate model
            'voter_id', // Foreign key on votes table...
            'id',           // Foreign key on voters table (primary key)
            'id',           // Local key on candidates table
            'candidate_id'      // Local key on votes table that points to voters
        );
    }

    /**
     * Get all of the Votes for the Voter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'voter_id', 'id');
    }

}
