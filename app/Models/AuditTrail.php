<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{

    use HasFactory;

    protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'event',
        'causer_type',
        'causer_id',
        'properties',
        'batch_uuid',
    ];

    protected $casts = [
        'properties' => 'json'
    ];

    protected $table = 'activity_log';

    public function type()
    {
        $type = str_replace('App\Models', '', $this->subject_type);

        return stripslashes($type);
    }

    /**
     * Get the user that owns the AuditTrail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'causer_id');
    }

}
