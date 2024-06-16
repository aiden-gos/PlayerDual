<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $vip_user = User::query()->orderBy("balance", "DESC")->limit(15)->get();
        $hot_user = User::query()->orderBy("price", "DESC")->limit(15)->get();
        $games = Game::all();
        $stories = Story::where('status', 'open')->orderBy('created_at', 'desc')->take(10)->get();
        return view('2home', [
            'vip_user' => $vip_user,
            'hot_user' => $hot_user,
            'games' => $games,
            'stories' => $stories
        ]);
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

        if (!empty($request->route("game"))) {
            $gameId = $request->route("game");
            $user->whereHas('games', function ($query) use ($gameId) {
                $query->where('game_id', $gameId);
            });
        }

        $reslut = $user->paginate(20);
        return response()->json($reslut, 200);
    }
}
