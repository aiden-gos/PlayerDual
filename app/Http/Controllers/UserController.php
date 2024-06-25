<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use App\Models\Follow;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function get(Request $request)
    {
        $id = $request->route('id');
        $user = User::where('id', $id)->first();
        $gallery = Gallery::where('user_id', $id)->take(5)->get();

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

        $follow = false;
        $orderConflict = false;
        $userStatus = false;
        $preOrderStatus = false;
        $rate = [];
        $showRate = false;
        try {
            $follow = Follow::where('following_user_id', $request->user()->id)
                ->where('followed_user_id', $id)
                ->exists();

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

            $preOrderStatus = Order::where(function ($query) use ($request, $user) {
                $query->where('ordering_user_id', $request->user()->id)->where('status', '=', 'accepted')
                    ->orWhere('ordered_user_id', $request->user()->id)->where('status', '=', 'accepted')

                    ->orWhere('ordering_user_id', $request->user()->id)->where('status', '=', 'pending')
                    ->orWhere('ordered_user_id', $request->user()->id)->where('status', '=', 'pending')

                    ->orWhere('ordering_user_id', $request->user()->id)->where('status', '=', 'pre-ordering')
                    ->orWhere('ordered_user_id', $request->user()->id)->where('status', '=', 'pre-ordering')

                    ->orWhere('ordering_user_id', $user->id)->where('status', '=', 'pre-ordered')
                    ->orWhere('ordered_user_id', $user->id)->where('status', '=', 'pre-ordered');
            })
                ->exists();

            //Get Rate
            $rate = Rate::where('user_id', $user->id)
                ->orderByRaw('CASE WHEN author_id = ? THEN 0 ELSE 1 END, created_at DESC', [$request->user()->id])
                ->paginate(10);

            //ShowRate
            $orderCount = Order::where('ordering_user_id', $request->user()->id)
                ->where('ordered_user_id', $user->id)
                ->count();

            $rateCount = Rate::where('user_id', $user->id)
                ->where('author_id', $request->user()->id)
                ->count();

            $showRate = $orderCount > 0 && $rateCount < $orderCount && isset($request->user()->id) && $request->user()->id != $user->id;
        } catch (\Throwable $th) {
            Log::error($th);
        }

        return view('user', [
            'user' => $user,
            'follow' => $follow,
            'orderConflict' => $orderConflict || $user->price == 0,
            'userStatus' => $userStatus,
            'preOrderStatus' => $preOrderStatus || $user->price == 0,
            'rate' => $rate,
            'showRate' => $showRate,
            'gallery' => $gallery,
            'top_donate' => $top_donate,
        ]);
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
        $donate = User::where('id', $request->user()->id)->first()->donating()->orderBy("created_at", "DESC")->paginate(8);
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
