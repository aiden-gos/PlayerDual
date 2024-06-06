<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordering_user_id',
        'ordered_user_id',
        'message',
        'status',
        'price',
        'duration',
        'total_price'
    ];
}
