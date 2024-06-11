<?php

namespace App\Http\Controllers;

use App\Events\EventActionNotify;
use App\Models\Order;
use App\Models\User;
use App\Notifications\ActionNotify;
use App\Notifications\RentNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                    'total_price' => $cost,
                ]);

                $user_ordered->notify(new ActionNotify([$request->user()->name . " rent you now"]));
                $user_ordered->notify(new RentNotify($request->user()->id, $request->user()->name));
                //Realtime notification

                event(new EventActionNotify($user_ordered->id, $request->user()->name . " rent you now"));
                event(new EventActionNotify($user_ordered->id.'-rent', ['order' => $order, 'user' => $request->user()]));
            } catch (\Throwable $th) {
                Log::error($th);
            }
        }
        return redirect()->back();
    }

    public function off(Request $request)
    {
        $user_id = $request->input('user_id');
        $durationTime = $request->input('time');

        $user_ordered = User::find(['id'=>$user_id])->first();

        try {
            $order = Order::create([
                'ordering_user_id' => $request->user()->id,
                'ordered_user_id' => $user_ordered->id,
                'status' => 'accepted',
                'price' => 0,
                'duration' => $durationTime,
                'total_price' => 0,
                'message' => 'off'
            ]);

            $user_ordered->notify(new ActionNotify([$request->user()->name . " rent you now"]));
            //Realtime notification

            event(new EventActionNotify($user_ordered->id, $request->user()->name . " rent you now"));
            event(new EventActionNotify($user_ordered->id.'-rent', ['order' => $order, 'user' => $request->user()]));
        } catch (\Throwable $th) {
            Log::error($th);
        }

        return redirect()->back();
    }

    public function acceptRent(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->input('id');
            $order = Order::find(['id'=>$id])->first();

            $order->update([
                'status'=> 'accepted',
                'start_at' => now(),
                'end_at' => now()->addHours($order->duration)
            ]);

            $user = User::find(["id" => $order->ordering_user_id])->first();

            $user->update(['balance' => $user->balance - $order->total_price]);
            DB::commit();

            event(new EventActionNotify($order->ordering_user_id.'-rent-request', ['order' => $order]));
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
        }
        return redirect()->back();
    }

    public function rejectRent(Request $request)
    {
        try {
            $id = $request->input('id');
            $order = Order::find(['id'=>$id])->first();

            $order->update([
                'status'=> 'rejected'
            ]);

            event(new EventActionNotify($order->ordering_user_id.'-rent-request', ['order' => $order]));

        } catch (\Throwable $th) {
            Log::error($th);
        }
        return redirect()->back();
    }

    public function endRent(Request $request)
    {
        try {
            $id = $request->input('id');
            $order = Order::find(['id'=>$id])->first();

            $order->update([
                'status'=> 'completed',
                'end_at' => now()
            ]);

            event(new EventActionNotify($order->ordered_user_id.'-rent-request', ['order' => $order]));

        } catch (\Throwable $th) {
            Log::error($th);
        }
        return redirect()->back();
    }

    private function checkUserBalance(Request $request, $user_ordered, $cost)
    {

        if($request->user()->balance >= $cost){
            return true;
        }
        return false;
    }

}
