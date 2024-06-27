<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function get(Request $request)
    {
        $data = $this->userService->get($request);

        return view('user', $data);
    }

    public function follow(Request $request)
    {
        $follow = User::where('id', $request->user()->id)->first()->following()->paginate(10);
        return view('history.follow', [
            'follow' => $follow,
        ]);
    }

    public function donateHistory(Request $request)
    {
        $donate = User::where('id', $request->user()->id)
            ->first()->donating()
            ->orderBy("created_at", "DESC")
            ->paginate(8);

        return view('history.donate', [
            'donate' => $donate,
        ]);
    }

    public function rentHistory(Request $request)
    {
        $rent = Order::where('ordering_user_id', $request->user()->id)
            ->orderBy("created_at", "DESC")
            ->paginate(8);

        Log::info($rent);
        return view('history.rent', [
            'rent' => $rent,
        ]);
    }
}
