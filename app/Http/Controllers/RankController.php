<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RankController extends Controller
{
    public function getRankIncome(Request $request)
    {
        $day = $request->route('day') ?? 1;

        $ordersSubquery = DB::table('orders')
            ->select('ordered_user_id as user_id', DB::raw('SUM(total_price) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays($day))
            ->groupBy('ordered_user_id');

        $donatesSubquery = DB::table('donates')
            ->select('donated_user_id as user_id', DB::raw('SUM(price) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays($day))
            ->groupBy('donated_user_id');

        $users = DB::table('users')
            ->select('users.*', DB::raw('(IFNULL(o.total, 0) + IFNULL(d.total, 0)) as price_all'))
            ->leftJoinSub($ordersSubquery, 'o', 'users.id', '=', 'o.user_id')
            ->leftJoinSub($donatesSubquery, 'd', 'users.id', '=', 'd.user_id')
            ->groupBy('users.id')
            ->havingRaw('price_all > 0')
            ->orderBy('price_all', 'desc')
            ->take(10)
            ->get();

        return response()->json($users);
    }

    public function getRankOutcome(Request $request)
    {
        $day = $request->route('day') ?? 1;

        $ordersSubquery = DB::table('orders')
            ->select('ordering_user_id as user_id', DB::raw('SUM(total_price) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays($day))
            ->groupBy('ordering_user_id');

        $donatesSubquery = DB::table('donates')
            ->select('donating_user_id as user_id', DB::raw('SUM(price) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays($day))
            ->groupBy('donating_user_id');

        $users = DB::table('users')
            ->select('users.*', DB::raw('(IFNULL(o.total, 0) + IFNULL(d.total, 0)) as price_all'))
            ->leftJoinSub($ordersSubquery, 'o', 'users.id', '=', 'o.user_id')
            ->leftJoinSub($donatesSubquery, 'd', 'users.id', '=', 'd.user_id')
            ->groupBy('users.id')
            ->havingRaw('price_all > 0')
            ->orderBy('price_all', 'desc')
            ->take(10)
            ->get();

        return response()->json($users);
    }
}
