<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    const TYPE_IMAGE = "image";
    const TYPE_VIDEO = "video";

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'link',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
