<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class DocumentType extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['id','name','description'];

    use LogsActivity;
    //use Spatie\Activitylog\LogOptions;
    //use Spatie\Activitylog\Traits\LogsActivity;

   public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logAll()
        ->logOnlyDirty();
    }


    /**
     * Get all of the Documents for the DocumentType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'document_type_id', 'id');
    }
}
