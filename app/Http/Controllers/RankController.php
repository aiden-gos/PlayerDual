<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankController extends Controller
{
    public function getRankIncome()
    {
        return User::select('users.*', DB::raw('SUM(orders.total_price + donates.price) as income'))
            ->leftJoin('orders', function($join) {
                $join->on('users.id', '=', 'orders.ordered_user_id')
                     ->where('orders.created_at', '>=', Carbon::now()->subDays(7));
            })
            ->leftJoin('donates', function($join) {
                $join->on('users.id', '=', 'donates.donated_user_id')
                     ->where('donates.created_at', '>=', Carbon::now()->subDays(7));
            })
            ->groupBy('users.id')
            ->orderBy('income', 'desc')
            ->take(10)
            ->get();
    }

    public function getRankOutcome()
    {
        return User::select('users.*', DB::raw('SUM(orders.total_price + donates.price) as outcome'))
            ->leftJoin('orders', function($join) {
                $join->on('users.id', '=', 'orders.ordering_user_id')
                     ->where('orders.created_at', '>=', Carbon::now()->subDays(7));
            })
            ->leftJoin('donates', function($join) {
                $join->on('users.id', '=', 'donates.donating_user_id')
                     ->where('donates.created_at', '>=', Carbon::now()->subDays(7));
            })
            ->groupBy('users.id')
            ->orderBy('outcome', 'desc')
            ->take(10)
            ->get();
    }
}
