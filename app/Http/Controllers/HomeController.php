<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $vip_user = User::query()->orderBy("balance","DESC")->limit(15)->get();
        $hot_user = User::query()->orderBy("price","DESC")->limit(15)->get();
        $games = Game::all();

        return view('welcome',[
            'vip_user'=> $vip_user,
            'hot_user'=> $hot_user,
            'games' => $games
        ]);
    }

    public function search(Request $request)
    {
        $user = User::query();

        if(!empty($request->query("name"))){

            $user->where('name', 'like', '%'.$request->query('name').'%');
        }
        if($request->query("sex") == "1" || $request->query("sex") == "0"){
            $user->where("sex",$request->query("sex"));
        }
        if(!empty($request->query("priceMin"))){
            $user->where("price" ,">", $request->query("priceMin"));
        }
        if(!empty($request->query("priceMax"))){
            $user->where("price","<", $request->query("priceMax"));
        }
        if(!empty($request->query("priceMax"))){
            $user->where("price","<", $request->query("priceMax"));
        }
        if(!empty($request->query("game"))){
            $gameId = $request->query("game");
            $user->whereHas('games', function ($query) use ($gameId) {
                $query->where('game_id', $gameId);
            });
        }
        Log::debug("game:" . $request->query("game"));
        Log::debug($user->getQuery()->toSql());
        $reslut = $user->limit(20)->get();
        return response()->json($reslut, 200);
    }
}
