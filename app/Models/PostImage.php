<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostImage extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'post_id',
        'image',
    ];

    /**
     * Get the post that owns the PostImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
