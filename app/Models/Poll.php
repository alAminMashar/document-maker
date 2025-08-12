<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'starting_at',
        'ending_at',
        'user_id',
    ];

    /**
     * Get all of the votes for the Poll
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'poll_id', 'id');
    }

    /**
     * Get all of the Voters for the Poll
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function voters(): HasManyThrough
    {
        return $this->hasManyThrough(Voter::class, Vote::class);
    }

    /**
     * Get all of the candidates for the Poll
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function candidates(): HasManyThrough
    {
        return $this->hasManyThrough(Candidate::class, Vote::class);
    }

    /**
     * Get the user that owns the Poll
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
