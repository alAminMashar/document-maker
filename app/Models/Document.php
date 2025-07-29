<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class Document extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'slug',
        'description',
        'documentable_id',
        'documentable_type',
        'document_type_id',
        'original_received',
        'mime_type',
        'size',
        'file_name',
    ];

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
     * Get the parent documentable model
     * e.g. (Employee, Occurrence, PaymentInstallment).
     * Retreive records by
     */
    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the type that owns the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function getSize()
    {
        $bytes = $this->size;
           if ($bytes >= 1073741824)
            {
                $bytes = number_format($bytes / 1073741824, 2) . ' GB';
            }
            elseif ($bytes >= 1048576)
            {
                $bytes = number_format($bytes / 1048576, 2) . ' MB';
            }
            elseif ($bytes >= 1024)
            {
                $bytes = number_format($bytes / 1024, 2) . ' KB';
            }
            elseif ($bytes > 1)
            {
                $bytes = $bytes . ' bytes';
            }
            elseif ($bytes == 1)
            {
                $bytes = $bytes . ' byte';
            }
            else
            {
                $bytes = '0 bytes';
            }

            return $bytes;
    }

    public static function upload($slug, $docu_id, $docu_type, $type_id, $org, $type, $size, $name,$desc = null)
    {

        $document = Document::create([
            'slug'                  =>  $slug,
            'description'           =>  $desc,
            'documentable_id'       =>  $docu_id,
            'documentable_type'     =>  $docu_type,
            'document_type_id'      =>  $type_id,
            'original_received'     =>  $org,
            'mime_type'             =>  $type,
            'size'                  =>  $size,
            'file_name'             =>  $name,
        ]);

        return $document;

    }

    public function sendToMail($address)
    {
        //Send this document's file as attachment to the above address.

    }

}
