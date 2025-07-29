<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Disapproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'modification_id',
        'user_id',
        'reason',
    ];

    /**
     * Get the user that owns the Approval
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the Modification that owns the ModificationPayload
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modification(): BelongsTo
    {
        return $this->belongsTo(Modification::class, 'modification_id', 'id');
    }

}
