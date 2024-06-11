<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Order;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;

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

            $orderConflict = Order::where('status', '<>', 'completed')->where('status', '<>', 'rejected')->where(function ($query) use ($request, $user) {
                $query->where('ordering_user_id', $request->user()->id)
                    ->orWhere('ordered_user_id', $request->user()->id)
                    ->orWhere('ordering_user_id', $user->id)
                    ->orWhere('ordered_user_id', $user->id);
            })
                ->whereRaw('DATE_ADD(updated_at, INTERVAL duration HOUR) > NOW()')
                ->first();

            $userStatus = Order::where('status', '<>', 'completed')
                ->where('status', '<>', 'rejected')
                ->where('status', '<>', 'pre-ordering')
                ->where(function ($query) use ($request, $user) {
                    $query->where('ordering_user_id', $user->id)
                        ->orWhere('ordered_user_id', $user->id);
                })
                ->whereRaw('DATE_ADD(updated_at, INTERVAL duration HOUR) > NOW()')
                ->first();

            $preOrderStatus = Order::where(function ($query) use ($request, $user) {
                $query->where('ordering_user_id', $request->user()->id)->where('status', '=', 'accepted')
                    ->orWhere('ordered_user_id', $request->user()->id)->where('status', '=', 'accepted')
                    ->orWhere('ordering_user_id', $user->id)->where('status', '=', 'pending')
                    ->orWhere('ordered_user_id', $user->id)->where('status', '=', 'pending')
                    ->orWhere('ordering_user_id', $user->id)->where('status', '=', 'pre-ordering')
                    ->orWhere('ordered_user_id', $user->id)->where('status', '=', 'pre-ordering')
                    ->orWhere('ordering_user_id', $user->id)->where('status', '=', 'pre-ordered')
                    ->orWhere('ordered_user_id', $user->id)->where('status', '=', 'pre-ordered');
            })
                ->first();

            //Get Rate
            $rate = Rate::where('user_id', $user->id)
                ->orderByRaw('CASE WHEN author_id = ? THEN 0 ELSE 1 END, created_at DESC', [$request->user()->id])
                ->paginate(10);

            //ShowRate
            $orderExits = Order::where('ordering_user_id', $request->user()->id)
                ->where('ordered_user_id', $user->id)
                ->exists();
            $rateExits = Rate::where('user_id', $user->id)
                ->where('author_id', $request->user()->id)
                ->exists();
            $showRate = $orderExits && !$rateExits && $request->user()->id != $user->id;
        } catch (\Throwable $th) {
        }

        return view('user', [
            'user' => $user,
            'follow' => $follow,
            'orderConflict' => $orderConflict,
            'userStatus' => $userStatus,
            'preOrderStatus' => $preOrderStatus,
            'rate' => $rate,
            'showRate' => $showRate,
        ]);
    }
}
