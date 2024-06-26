<?php

namespace App\Services;

use App\Models\Follow;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function __construct()
    {
        //
    }

    public function get(Request $request)
    {
        $id = $request->route('id');
        $user = User::where('id', $id)->first();

        if ($user == null) {
            return abort('404');
        }

        $gallery = Gallery::where('user_id', $id)->take(5)->get();
        $top_donate = self::getTopDonate($id);

        $follow = self::getFollowStatus($request, $id);

        $orderConflict = self::isExistOrderConflict($request, $user);

        $userStatus = self::getUserStatus($request, $user);

        $preOrderStatus = self::isExistPreOrderConflict($request, $user);

        //Get Rate
        $rate = self::getRate($request, $user);

        $showRate = self::isShowRateForm($request, $user);

        return view('user', [
            'user' => $user,
            'follow' => $follow,
            'orderConflict' => $orderConflict || $user->price == 0,
            'userStatus' => $userStatus,
            'preOrderStatus' => $preOrderStatus || $user->price == 0,
            'rate' => $rate,
            'showRate' => $showRate['showRate'],
            'gallery' => $gallery,
            'top_donate' => $top_donate,
            'rateCount' => $showRate['rateCount'],
            'orderCount' => $showRate['orderCount'],
        ]);
    }

    private function getTopDonate($id)
    {
        $donatesSubquery = DB::table('donates')
            ->select('donating_user_id as user_id', DB::raw('SUM(price) as total'))
            ->where('donated_user_id', $id)
            ->groupBy('donating_user_id');

        $top_donate = DB::table('users')
            ->select('users.*', DB::raw('IFNULL(d.total, 0) as donate_price'))
            ->leftJoinSub($donatesSubquery, 'd', 'users.id', '=', 'd.user_id')
            ->groupBy('users.id')
            ->havingRaw('donate_price > 0')
            ->orderBy('donate_price', 'desc')
            ->take(10)
            ->get();

        return $top_donate;
    }

    private function getFollowStatus(Request $request, $id)
    {
        $follow  = false;
        try {
            $follow = Follow::where('following_user_id', $request->user()->id)
                ->where('followed_user_id', $id)
                ->exists();
        } catch (\Throwable $th) {
            Log::error($th);
        }
        return $follow;
    }

    private function isExistOrderConflict($request, $user)
    {
        $orderConflict = false;

        try {
            $orderConflict = Order::where('status', '=', 'accepted')->where(function ($query) use ($request, $user) {
                $query->where('ordering_user_id', $request->user()->id)
                    ->orWhere('ordered_user_id', $request->user()->id)
                    ->orWhere('ordering_user_id', $user->id)
                    ->orWhere('ordered_user_id', $user->id);
            })->orWhere(function ($query) use ($request, $user) {
                $query->where('ordering_user_id', $request->user()->id)
                    ->where('status', '=', 'pending');
            })
                ->exists();
        } catch (\Throwable $th) {
            Log::error($th);
        }

        return $orderConflict;
    }

    private function getUserStatus($request, $user)
    {
        $userStatus = false;
        try {
            $userStatus = Order::where('status', '<>', 'completed')
                ->where('status', '<>', 'rejected')
                ->where('status', '<>', 'pre-ordering')
                ->where('status', '<>', 'pending')
                ->where(function ($query) use ($request, $user) {
                    $query->where('ordering_user_id', $user->id)
                        ->orWhere('ordered_user_id', $user->id);
                })
                ->whereRaw('DATE_ADD(updated_at, INTERVAL duration HOUR) > NOW()')
                ->exists();
        } catch (\Throwable $th) {
            Log::error($th);
        }
        return $userStatus;
    }

    private function isExistPreOrderConflict($request, $user)
    {
        $preOrderConflict = false;

        try {
            $preOrderConflict = Order::where(function ($query) use ($request, $user) {
                $query->where('ordering_user_id', $request->user()->id)->where('status', '=', 'accepted')
                    ->orWhere('ordered_user_id', $request->user()->id)->where('status', '=', 'accepted')
                    ->orWhere('ordering_user_id', $request->user()->id)->where('status', '=', 'pending')
                    ->orWhere('ordered_user_id', $request->user()->id)->where('status', '=', 'pending')
                    ->orWhere('ordering_user_id', $request->user()->id)->where('status', '=', 'pre-ordering')
                    ->orWhere('ordered_user_id', $request->user()->id)->where('status', '=', 'pre-ordering')
                    ->orWhere('ordering_user_id', $user->id)->where('status', '=', 'pre-ordered')
                    ->orWhere('ordered_user_id', $user->id)->where('status', '=', 'pre-ordered');
            })->exists();
        } catch (\Throwable $th) {
            Log::error($th);
        }

        return $preOrderConflict;
    }

    private function getRate($request, $user)
    {
        $rate = [];
        try {
            $rate = Rate::where('user_id', $user->id)
                ->orderByRaw('CASE WHEN author_id = ? THEN 0 ELSE 1 END, created_at DESC', [$request->user()->id])
                ->paginate(10);
        } catch (\Throwable $th) {
            Log::error($th);
        }

        return $rate;
    }

    private function isShowRateForm($request, $user)
    {
        $showRate = false;
        $orderCount = 0;
        $rateCount = 0;
        try {
            $orderCount = Order::where('ordering_user_id', $request->user()->id)
                ->where('ordered_user_id', $user->id)
                ->count();
            
            $rateCount = Rate::where('user_id', $user->id)
                ->where('author_id', $request->user()->id)
                ->count();
            
            $showRate = $orderCount > 0 && $rateCount < $orderCount &&
                isset($request->user()->id) && $request->user()->id != $user->id;
        } catch (\Throwable $th) {
            Log::debug($th);
        }

        return [
            'showRate' => $showRate,
            'orderCount' => $orderCount,
            'rateCount' => $rateCount
        ];
    }
}
