<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'title',
        'content',
        'published_at',
        'published_by',
        'created_by',
        'published',
    ];

    public function getQR()
    {

        $route = route('letter.verify',['serial_number'=>$this->serial_number]);

        $file_name = date('Y M d ').$this->serial_number.'.png';
        $from = [255, 0, 0];
        $to = [0, 0, 255];

        $qr_code = QrCode::size(250)
        ->format('png')
        ->margin(1)
        ->errorCorrection('M')
        ->generate($route);

        return $qr_code;

    }

    /**
     * Get the user that published the Letter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'published_by', 'id');
    }

    /**
     * Get the user that created the Letter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}
