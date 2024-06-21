<?php

namespace App\Services;

use App\Events\EventActionNotify;
use App\Models\Order;
use App\Models\User;
use App\Notifications\ActionNotify;
use App\Notifications\RentNotify;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreOrderService
{
    public function __construct()
    {
        //
    }

    public function preOrder(Request $request, $user_id, $durationTime, $msg)
    {

        if (empty($user_id) || empty($durationTime)) {
            return redirect()->back();
        }

        $user_ordered = User::find(['id' => $user_id])->first();

        $cost = $user_ordered->price * $durationTime;

        if (self::checkUserBalance($request, $user_ordered, $cost)) {
            try {
                $order = Order::create([
                    'ordering_user_id' => $request->user()->id,
                    'ordered_user_id' => $user_ordered->id,
                    'message' => $msg,
                    'status' => 'pre-ordering',
                    'price' => $user_ordered->price,
                    'duration' => $durationTime,
                    'total_price' => $cost,
                ]);

                $user_ordered->notify(new ActionNotify([$request->user()->name . " pre-order you now"]));
                $user_ordered->notify(new RentNotify($request->user()->id, $request->user()->name));
                //Realtime notification

                event(new EventActionNotify($user_ordered->id, $request->user()->name . " pre-order you now"));
                event(new EventActionNotify($user_ordered->id . '-pre-order', ['preOrder' => $order, 'user' => $request->user()]));
            } catch (\Throwable $th) {
                Log::error($th);
            }
        }
        return redirect()->back();
    }

    public function acceptRent(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            if (empty($id))
                return redirect()->back();

            $order = Order::find(['id' => $id])->first();
            $currentOrder = Order::where('ordered_user_id', $order->ordered_user_id)->where('status', 'accepted')->first();
            $order->update([
                'status' => 'pre-ordered',
                'start_at' => $currentOrder->end_at,
                'end_at' => date('Y-m-d H:i:s', strtotime($currentOrder->end_at . ' + ' . $order->duration . ' hours'))
            ]);

            $orderRJ = Order::where('ordered_user_id', $order->ordered_user_id)
                ->where('orders.status', 'pre-ordering');

            $orderRJ->update([
                'status' => 'rejected'
            ]);

            foreach ($orderRJ->get() as $item) {
                event(new EventActionNotify($item->ordering_user_id . '-pre-order-request', ['order' => $order]));
            }

            $user = User::find(["id" => $order->ordering_user_id])->first();
            $user->update(['balance' => $user->balance - $order->total_price]);

            $user_ordered = User::find(["id" => $order->ordered_user_id])->first();
            $user_ordered->update(['balance' => $user_ordered->balance + $order->total_price]);

            event(new EventActionNotify($order->ordering_user_id . '-pre-order-request', ['order' => $order]));
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
        }
        return redirect()->back();
    }

    public function rejectRent(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            if (!empty($id)) {

                $order = Order::find(['id' => $id])->first();

                $order->update([
                    'status' => 'rejected'
                ]);

                event(new EventActionNotify($order->ordering_user_id . '-pre-order-request', ['order' => $order]));

                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
        }
        return redirect()->back();
    }

    public function endRent(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            if (!empty($id)) {
                $order = Order::find(['id' => $id, 'status' => 'accepted'])->first();

                if ($request->user()->id == $order->ordered_user_id) {
                    $order->update([
                        'status' => 'rejected'
                    ]);

                    $user = User::find(["id" => $order->ordered_user_id])->first();
                    $user->update(['balance' => $user->balance - $order->total_price]);

                    $user_ordering = User::find(["id" => $order->ordering_user_id])->first();
                    $user_ordering->update(['balance' => $user_ordering->balance + $order->total_price]);
                } else {
                    $order->update([
                        'status' => 'completed'
                    ]);
                }

                event(new EventActionNotify($order->ordered_user_id . '-pre-order-request', ['order' => $order]));
                event(new EventActionNotify($order->ordering_user_id . '-pre-order-request', ['order' => $order]));

                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
        }
        return redirect()->back();
    }

    private function checkUserBalance(Request $request, $user_ordered, $cost)
    {

        if ($request->user()->balance >= $cost) {
            return true;
        }
        return false;
    }
}
