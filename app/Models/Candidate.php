<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'political_party_id',
        'vote_count',
        'multiplier',
        'active',
    ];

    /**
     * Get all of the votes for the Candidate
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'candidate_id', 'id');
    }

    /**
     * Get all of the Voters for the Candidate
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function voters(): HasManyThrough
    {
        return $this->hasManyThrough(Voter::class, Vote::class);
    }

    /**
     * Get the politicalParty that owns the Candidate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function politicalParty(): BelongsTo
    {
        return $this->belongsTo(PoliticalParty::class, 'political_party_id', 'id');
    }

}
