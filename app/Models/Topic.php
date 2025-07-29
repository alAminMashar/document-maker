<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    /**
     * Get all of the SubTopics for the Topic
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subTopics(): HasMany
    {
        return $this->hasMany(SubTopic::class, 'topic_id', 'id');
    }

    /**
     * Get all of the Articles for the Topic
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function articles(): HasManyThrough
    {
        return $this->hasManyThrough(Article::class, SubTopic::class);
    }

}
