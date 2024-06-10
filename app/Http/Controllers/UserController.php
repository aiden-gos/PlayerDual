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
        $userStatus = false;
        try {
            $follow = Follow::where('following_user_id', $request->user()->id)
            ->where('followed_user_id', $id)
            ->first();

            $orderConflict = Order::where('status','<>' ,'completed')->where('status','<>' ,'rejected')->where(function ($query) use ($request, $user) {
                $query->where('ordering_user_id', $request->user()->id)
                    ->orWhere('ordered_user_id', $request->user()->id)
                    ->orWhere('ordering_user_id', $user->id)
                    ->orWhere('ordered_user_id', $user->id);
            })
            ->whereRaw('DATE_ADD(updated_at, INTERVAL duration HOUR) > NOW()')
            ->first();

            $userStatus = Order::where('status','<>' ,'completed')->where('status','<>' ,'rejected')->where(function ($query) use ($request, $user) {
                $query->where('ordering_user_id', $user->id)
                    ->orWhere('ordered_user_id', $user->id);
            })
            ->whereRaw('DATE_ADD(updated_at, INTERVAL duration HOUR) > NOW()')
            ->first();

        } catch (\Throwable $th) {
        }

        return view('user', [
            'user' => $user,
            'follow' => $follow,
            'orderConflict' => $orderConflict,
            'userStatus' => $userStatus
        ]);
    }
}
