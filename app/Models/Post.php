<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Multicaret\Acquaintances\Traits\CanBeFavorited;
use Multicaret\Acquaintances\Traits\CanBeLiked;

class Post extends Model
{
    use HasFactory, SoftDeletes, CanBeLiked, CanBeFavorited;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'content',
    ];

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reposts()
    {
        return $this->hasMany(Repost::class);
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable')->with('user');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable')->with('user');
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoriteable')->with('user');
    }

    public function repost_user()
    {
        return $this->hasManyThrough(User::class, Repost::class, 'post_id', 'id', 'id', 'user_id');
    }
}
