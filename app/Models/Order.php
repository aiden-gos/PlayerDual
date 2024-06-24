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

    protected $with = ['ordering_user', 'ordered_user'];

    public function orderingUser()
    {
        return $this->belongsTo(User::class, 'ordering_user_id');
    }

    public function orderedUser()
    {
        return $this->belongsTo(User::class, 'ordered_user_id');
    }
}
