<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeService
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $vip_user = self::getVipUsers();
        $hot_user = self::getHotUsers();
        $games = Game::all();
        $stories = Story::where('status', 'open')->orderBy('created_at', 'desc')->take(10)->get();
        return view('home', [
            'vip_user' => $vip_user,
            'hot_user' => $hot_user,
            'games' => $games,
            'stories' => $stories
        ]);
    }

    private function getHotUsers()
    {
        $hotUsers = User::query()
            ->join('orders', 'users.id', '=', 'orders.ordered_user_id')
            ->selectRaw('users.*, count(orders.id) as order_count')
            ->where('orders.created_at', '>', now()->subDays(15))
            ->orderBy('order_count', 'DESC')
            ->groupBy('users.id')
            ->limit(15)
            ->get();

        return $hotUsers;
    }

    private function getVipUsers()
    {
        $ordersSubquery = DB::table('orders')
            ->select('ordered_user_id as user_id', DB::raw('SUM(total_price) as total'))
            ->where('created_at', '>=', now()->subDays(15))
            ->groupBy('ordered_user_id');

        $vipUsers = DB::table('users')
            ->select('users.*', DB::raw('(IFNULL(o.total, 0)) as price_all'))
            ->leftJoinSub($ordersSubquery, 'o', 'users.id', '=', 'o.user_id')
            ->groupBy('users.id')
            ->havingRaw('price_all > 0')
            ->orderBy('price_all', 'desc')
            ->take(10)
            ->get();

        return $vipUsers;
    }

    public function search(Request $request)
    {
        $user = User::query();

        if (!empty($request->query("name"))) {
            $user->where('name', 'like', '%' . $request->query('name') . '%');
        }
        if ($request->query("sex") == "1" || $request->query("sex") == "0") {
            $user->where("sex", $request->query("sex"));
        }
        if (!empty($request->query("priceMin"))) {
            $user->where("price", ">", $request->query("priceMin"));
        }
        if (!empty($request->query("priceMax"))) {
            $user->where("price", "<", $request->query("priceMax"));
        }
        if (!empty($request->query("priceMax"))) {
            $user->where("price", "<", $request->query("priceMax"));
        }
        if (!empty($request->query("game"))) {
            $gameId = $request->query("game");
            $user->whereHas('games', function ($query) use ($gameId) {
                $query->where('game_id', $gameId);
            });
        }

        $reslut = $user->limit(20)->get();
        return response()->json($reslut, 200);
    }

    public function filterGame(Request $request)
    {
        $user = User::query();

        if (!empty($request->route("game")) && $request->route("game") != 'all') {
            $gameId = $request->route("game");
            $user->whereHas('games', function ($query) use ($gameId) {
                $query->where('game_id', $gameId);
            });
        }

        $reslut = $user->paginate(20);
        return response()->json($reslut, 200);
    }
}
