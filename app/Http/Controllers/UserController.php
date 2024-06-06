<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function get(Request $request)
    {
        $id = $request->route('id');
        $user = User::where('id', $id)->first();
        $follow = false;
        $orderConflict = false;
        try {
            $follow = Follow::where('following_user_id', $request->user()->id)
            ->where('followed_user_id', $id)
            ->first();

            $orderConflict = Order::where('status','<>','complete')->where('ordering_user_id', $request->user()->id)
                            ->orWhere('ordered_user_id', $request->user()->id)->where('status','<>','complete')
                            ->orWhere('ordering_user_id', $user->id)->where('status','<>','complete')
                            ->orWhere('ordered_user_id', $user->id)->where('status','<>','complete')
                            ->first();
        } catch (\Throwable $th) {
        }


        return view('user', [
            'user' => $user,
            'follow' => $follow,
            'orderConflict' => $orderConflict
        ]);
    }
}
