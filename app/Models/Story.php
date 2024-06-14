<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'video_link',
        'content',
        'user_id',
        'status',
        'view',
        'like',
    ];

    protected $with = ['user'];

    protected $appends = ['is_liked_by_user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getIsLikedByUserAttribute()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
}
