<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
    use HasFactory;

    protected $fillable = [
        'donating_user_id',
        'donated_user_id',
        'message',
        'price',
    ];

    protected $with = ['donating_user', 'donated_user'];

    public function donatingUser()
    {
        return $this->belongsTo(User::class, 'donating_user_id');
    }

    public function donatedUser()
    {
        return $this->belongsTo(User::class, 'donated_user_id');
    }
}
