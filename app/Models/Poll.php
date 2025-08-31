<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\DispatchVoteReportJob;
use App\Jobs\RunSchedules;
use Carbon\Carbon;
use Str;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'starting_at',
        'ending_at',
        'user_id',
        'force_target',
        'target_votes',
        'current_votes',
        'number_of_sessions',
    ];

    protected $casts = [
        'starting_at' => 'datetime',
        'ending_at'   => 'datetime', // if you have this
    ];

    protected $hidden = [
        'image',
        'has_started',
        'is_running',
        'active',
        'duration',
    ];

    protected $appends = ['duration'];

    /**
     * Get the duration in hours between starting_at and ending_at.
     */
    protected function getDurationAttribute()
    {
        if (!$this->starting_at || !$this->ending_at) {
            return null; // Return null if one date is missing
        }

        $start = Carbon::parse($this->starting_at);
        $end   = Carbon::parse($this->ending_at);

        return $start->diffInHours($end); // Always integer hours
    }

    public function getImageAttribute()
    {
        return 'assets/img/backgrounds/grey.png';
    }

    public function getHasStartedAttribute()
    {
        return $this->starting_at <= Carbon::now() ? true:false;
    }

    public function getIsRunningAttribute()
    {
        return $this->ending_at >= Carbon::now() ? true:false;
    }

    public function getActiveAttribute()
    {
        if($this->has_started && $this->is_running){
            return true;
        }
        return false;
    }

    public function updateCurrentVotes()
    {
        $this->update([
            'current_votes' => $this->votes()->count()
        ]);
    }

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class, 'poll_id', 'id');
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

    public function generateRealVoteReports()
    {
        return dispatch(new DispatchVoteReportJob($this->id, Str::limit($this->title,100,'')));
    }

    public function runMultipliers()
    {
        if($this->force_target && $this->target_votes > 0){
            return dispatch(new RunSchedules($this, $this->target_votes, $this->number_of_sessions));
        }

        return true;

    }
}
