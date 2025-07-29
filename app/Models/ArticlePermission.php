<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticlePermission extends Model
{

    use HasFactory;

    protected $fillable = [
        'article_id',
        'permission_id',
    ];

    /**
     * Get the Article that owns the ArticlePermission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'ariticle_id', 'id');
    }

    /**
     * Get the Permission that owns the ArticlePermission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

}
