<?php

namespace App\Http\Controllers;

use App\Events\EventActionNotify;
use App\Models\Order;
use App\Models\User;
use App\Notifications\ActionNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function rent(Request $request)
    {
        $user_id = $request->input('user_id');
        $durationTime = $request->input('time');
        $msg = $request->input('msg');

        $user_ordered = User::find(['id'=>$user_id])->first();

        $cost = $user_ordered->price * $durationTime;

        if(self::checkUserBalance($request, $user_ordered, $cost)){
            try {
                $order = Order::create([
                    'ordering_user_id' => $request->user()->id,
                    'ordered_user_id' => $user_ordered->id,
                    'message' => $msg,
                    'status' => 'pending',
                    'price' => $user_ordered->price,
                    'duration' => $durationTime,
                    'total_price' => $cost
                ]);

                $user_ordered->notify(new ActionNotify([$request->user()->name . " rent you now"]));
                //Realtime notification

                event(new EventActionNotify($user_ordered->id, $request->user()->name . " rent you now"));
                event(new EventActionNotify($user_ordered->id.'-rent', ['order' => $order, 'user' => $request->user()]));
            } catch (\Throwable $th) {
                Log::error($th);
            }
        }
        return redirect()->back();
    }

    public function acceptRent(Request $request)
    {
        try {
            $id = $request->input('id');
            Order::find(['id'=>$id])->first()->update([
                'status'=> 'accepted'
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
        return redirect()->back();
    }

    public function rejectRent(Request $request)
    {
        try {
            $id = $request->input('id');
            Order::find(['id'=>$id])->first()->update([
                'status'=> 'rejected'
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
        return redirect()->back();
    }

    private function checkUserBalance(Request $request, $user_ordered, $cost)
    {
        $orderConflict = Order::where('status','<>','complete')->where('ordering_user_id', $request->user()->id)
        ->orWhere('ordered_user_id', $request->user()->id)->where('status','<>','complete')->first();

        if($user_ordered && $request->user()->balance > $cost && !$orderConflict){
            return true;
        }
        return false;
    }

}
