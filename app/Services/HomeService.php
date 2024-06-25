<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeService
{
    const DAY = 15;
    
    public function __construct()
    {
        //
    }

    public function index()
    {
        $vip_user = self::getVipUsers();
        $hot_user = self::getHotUsers();
        $games = Game::all();
        $stories = Story::where('status', 'open')
            ->withCount(['likes' => function ($query) {
                $query->where('created_at', '>=', now()->subDays(self::DAY));
            }])
            ->orderByDesc('likes_count')
            ->limit(10)
            ->get();

        return view('home', [
            'vip_user' => $vip_user,
            'hot_user' => $hot_user,
            'games' => $games,
            'stories' => $stories
        ]);
    }

    private function getHotUsers()
    {
        $hotUsers = User::with(['games'])->withCount(['ordering' => function ($query) {
            $query->where('orders.created_at', '>', now()->subDays(self::DAY));
        }])
            ->orderBy('ordering_count', 'DESC')
            ->limit(15)
            ->get();
        return $hotUsers;
    }

    private function getVipUsers()
    {
        $ordersSubquery = DB::table('orders')
            ->select('ordered_user_id as user_id', DB::raw('SUM(total_price) as total'))
            ->where('created_at', '>=', now()->subDays(self::DAY))
            ->groupBy('ordered_user_id');

        $donatesSubquery = DB::table('donates')
            ->select('donated_user_id as user_id', DB::raw('SUM(price) as total'))
            ->where('created_at', '>=', now()->subDays(self::DAY))
            ->groupBy('donated_user_id');

        $vipUsers = User::with(['games']) // Correctly use `with` for Eloquent models
            ->select('users.*', DB::raw('(IFNULL(o.total, 0)+ IFNULL(d.total, 0)) as price_all'))
            ->leftJoinSub($ordersSubquery, 'o', function ($join) {
                $join->on('users.id', '=', 'o.user_id');
            })
            ->leftJoinSub($donatesSubquery, 'd', function ($join) {
                $join->on('users.id', '=', 'd.user_id');
            })
            ->groupBy('users.id')
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
