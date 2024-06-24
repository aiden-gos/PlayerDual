<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use CrudTrait;
    use HasApiTokens, HasFactory, Notifiable, Billable, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'balance',
        'country',
        'price',
        'sex',
        'role_id',
        'avatar',
        'title',
        'description',
        'micro',
        'camera',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $with = ['games'];
    protected $appends = [
        'follower_count', 'total_rental_hours',
        'completed_orders_percentage', 'average_rating', 'count_rating'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'followed_user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_user_id', 'following_user_id');
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function ordering()
    {
        return $this->belongsToMany(User::class, 'orders', 'ordering_user_id', 'ordered_user_id');
    }

    public function ordered()
    {
        return $this->belongsToMany(User::class, 'orders', 'ordered_user_id', 'ordering_user_id');
    }

    public function donating()
    {
        return $this->hasMany(Donate::class, 'donating_user_id');
    }

    public function donated()
    {
        return $this->hasMany(Donate::class, 'donated_user_id');
    }

    public function getFollowerCountAttribute()
    {
        return $this->followers()->count();
    }

    public function getTotalRentalHoursAttribute()
    {
        return $this->ordered()->sum('duration');
    }

    public function getCompletedOrdersPercentageAttribute()
    {
        $totalOrders = $this->ordered()->count();

        $completedOrders = $this->ordered()->where('orders.status', 'completed')->count();

        if ($totalOrders === 0) {
            return 0;
        }

        return ($completedOrders / $totalOrders) * 100;
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function getAverageRatingAttribute()
    {
        return number_format($this->rates()->avg('star'), 1);
    }

    public function getCountRatingAttribute()
    {
        return $this->rates()->count();
    }
}
