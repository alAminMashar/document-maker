<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{

    use HasFactory;

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
     * Get all of the Votes for the Voter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'voter_id', 'id');
    }

}
