<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\UpdateCandidateStats;
use Storage;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'poll_id',
        'political_party_id',
        'vote_count',
        'vote_percentage',
        'multiplier',
        'active',
    ];

    protected $hidden = [
        'image'
    ];

    public function getImageAttribute()
    {
        $photo = $this->documents->firstWhere('document_type_id', 110);

        if ($photo) {
            return asset($photo->file_name); // works because it's relative to public/
        }

        return asset('assets/img/backgrounds/orange.png');
    }

    public function updateSelf()
    {
        // Update candidate vote count and percentage
        $this->candidate->increment('vote_count');

        $percentage = ($this->vote_count / $this->poll->current_votes) * 100;
        $this->update([
            'vote_percentage'   =>  $percentage
        ]);

    }

    /**
     * Get the poll that owns the Candidate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class, 'poll_id', 'id');
    }

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
        return $this->hasManyThrough(
            Voter::class,   // final model
            Vote::class,    // intermediate model
            'candidate_id', // Foreign key on votes table...
            'id',           // Foreign key on voters table (primary key)
            'id',           // Local key on candidates table
            'voter_id'      // Local key on votes table that points to voters
        );
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

    /**
     * Get all of the user's documents.
     * Retreiving Documents $user->documents
     * use Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }


}
