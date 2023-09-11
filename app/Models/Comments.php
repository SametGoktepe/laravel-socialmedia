<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Multicaret\Acquaintances\Traits\CanBeFavorited;
use Multicaret\Acquaintances\Traits\CanBeLiked;

class Comments extends Model
{
    use HasFactory, SoftDeletes, CanBeLiked, CanBeFavorited;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'content',
        'commentable_id',
        'commentable_type',
    ];

    /**
     * Get all of the post's images.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
