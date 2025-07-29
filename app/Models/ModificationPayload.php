<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class ModificationPayload extends Model
{
    use HasFactory;

    protected $fillable = [
        'payload',
        'modification_id',
        'md5',
    ];

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
