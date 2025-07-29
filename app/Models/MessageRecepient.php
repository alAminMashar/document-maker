<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Model;

class MessageRecepient extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'message_id',
        'receivable_id',
        'receivable_type',
        'status',
    ];

    public function receivable(): MorphTo
    {
        return $this->morphTo();
    }

}
