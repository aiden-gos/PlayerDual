<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'ordering_user_id',
        'ordered_user_id',
        'message',
        'status',
        'price',
        'duration',
        'total_price',
        'start_at',
        'end_at'
    ];

    public function ordering_user()
    {
        return $this->belongsTo(User::class, 'ordering_user_id');
    }

    public function ordered_user()
    {
        return $this->belongsTo(User::class, 'ordered_user_id');
    }
}
