<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeService
{
    const SUB_DAY = 15;

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
            ->withCount(['likes', 'comments'])
            ->get()
            ->sortByDesc(function ($story) {
                return $story->likes_count + $story->comments_count;
            })
            ->take(10)
            ->values();

        return  [
            'vip_user' => $vip_user,
            'hot_user' => $hot_user,
            'games' => $games,
            'stories' => $stories
        ];
    }

    private function getHotUsers()
    {
        $hotUsers = User::with(['games'])->withCount(['ordered' => function ($query) {
            $query->where('orders.created_at', '>', now()->subDays(self::SUB_DAY));
        }])
            ->orderBy('ordered_count', 'DESC')
            ->limit(15)
            ->get();
        return $hotUsers;
    }

    private function getVipUsers()
    {
        $ordersSubquery = DB::table('orders')
            ->select('ordered_user_id as user_id', DB::raw('SUM(total_price) as total'))
            ->where('created_at', '>=', now()->subDays(self::SUB_DAY))
            ->groupBy('ordered_user_id');

        $donatesSubquery = DB::table('donates')
            ->select('donated_user_id as user_id', DB::raw('SUM(price) as total'))
            ->where('created_at', '>=', now()->subDays(self::SUB_DAY))
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

    public function search($name, $sex, $min_price, $max_price, $game)
    {
        $user = User::query();

        if (!empty($name)) {
            $user->where('name', 'like', '%' . $name . '%');
        }

        if ($sex == "1" || $sex == "0") {
            $user->where("sex", $sex);
        }

        if (!empty($min_price)) {
            $user->where("price", ">", $min_price);
        }

        if (!empty($max_price)) {
            $user->where("price", "<", $max_price);
        }

        if (!empty($game)) {
            $user->whereHas('games', function ($query) use ($game) {
                $query->where('game_id', $game);
            });
        }

        $result = $user->limit(20)->get();

        return $result;
    }

    public function filterGame($game)
    {
        $user = User::query();

        if (!empty($game) && $game != 'all') {
            $user->whereHas('games', function ($query) use ($game) {
                $query->where('game_id', $game);
            });
        }

        $reslut = $user->paginate(20);
        return $reslut;
    }
}
