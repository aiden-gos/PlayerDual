<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct()
    {
        $this->homeService = new HomeService();
    }

    public function index(Request $request)
    {
        $data = $this->homeService->index();

        return view('home', $data);
    }

    public function search(Request $request)
    {
        $name = $request->query("name");
        $sex = $request->query("sex");
        $min_price = $request->query("priceMin");
        $max_price = $request->query("priceMax");
        $game = $request->query("game");

        $result = $this->homeService->search($name, $sex, $min_price, $max_price, $game);

        return response()->json($result, 200);
    }

    public function filterGame(Request $request)
    {
        $game = $request->route("game");

        if ($game) {
            $result = $this->homeService->filterGame($game);
        } else {
            return response()->json(['msg' => "Require game id"], 400);
        }

        return response()->json($result, 200);
    }
}
