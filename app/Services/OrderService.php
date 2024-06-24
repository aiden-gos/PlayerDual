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

class OrderService
{
    public function __construct()
    {
        //
    }

    public function rent(Request $request, $user_id, $durationTime, $msg)
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
                    'status' => 'pending',
                    'price' => $user_ordered->price,
                    'duration' => $durationTime,
                    'total_price' => $cost,
                ]);

                $user_ordered->notify(new ActionNotify([$request->user()->name . " rent you now"]));
                $user_ordered->notify(new RentNotify($request->user()->id, $request->user()->name));
                //Realtime notification

                event(new EventActionNotify($user_ordered->id, $request->user()->name . " rent you now"));
                event(new EventActionNotify($user_ordered->id . '-rent', ['order' => $order, 'user' => $request->user()]));
            } catch (\Throwable $th) {
                Log::error($th);
            }
        }
        return redirect()->back();
    }

    public function off(Request $request, $user_id, $durationTime)
    {

        if (empty($user_id) || empty($durationTime)) {
            return redirect()->back();
        }

        $user_ordered = User::find(['id' => $user_id])->first();

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
            if (!empty($id)) {

                $order = Order::find(['id' => $id])->first();
                $order->update([
                    'status' => 'accepted',
                    'start_at' => now(),
                    'end_at' => now()->addHours($order->duration)
                ]);

                $orderRJ = Order::where('ordered_user_id', $order->ordered_user_id)
                    ->where('orders.status', 'pending');

                $orderRJ->update([
                    'status' => 'rejected'
                ]);

                foreach ($orderRJ->get() as $order) {
                    event(new EventActionNotify($order->ordering_user_id . '-rent-request', ['order' => $order]));
                }

                $user = User::find(["id" => $order->ordering_user_id])->first();
                $user->update(['balance' => $user->balance - $order->total_price]);

                $user_ordered = User::find(["id" => $order->ordered_user_id])->first();
                $user_ordered->update(['balance' => $user_ordered->balance + $order->total_price]);

                DB::commit();
                event(new EventActionNotify($order->ordering_user_id . '-rent-request', ['order' => $order]));
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
        }
        return redirect()->back();
    }

    public function rejectRent(Request $request, $id)
    {
        try {
            $order = Order::find(['id' => $id])->first();
            $order->update([
                'status' => 'rejected'
            ]);

            event(new EventActionNotify($order->ordering_user_id . '-rent-request', ['order' => $order]));
        } catch (\Throwable $th) {
            Log::error($th);
        }
        return redirect()->back();
    }

    public function endRent(Request $request, $id)
    {
        try {
            if (!empty($id)) {

                $order = Order::find(['id' => $id])->first();

                $order->update([
                    'status' => 'completed',
                    'end_at' => now()
                ]);

                event(new EventActionNotify($order->ordered_user_id . '-rent-request', ['order' => $order]));
            }
        } catch (\Throwable $th) {
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

    public function requestOrder(Request $request)
    {
        $renting = Order::select(['orders.*', 'users.name', 'users.avatar'])
            ->where('ordering_user_id', $request->user()->id)
            ->where('orders.status', 'accepted')
            ->whereRaw('DATE_ADD(orders.updated_at, INTERVAL orders.duration HOUR) > NOW()')
            ->join('users', 'ordered_user_id', 'users.id')
            ->first();

        $rented = Order::select(['orders.*', 'users.id', 'users.name', 'users.avatar'])
            ->where('ordered_user_id', $request->user()->id)
            ->where('orders.status', 'accepted')
            ->whereRaw('DATE_ADD(orders.updated_at, INTERVAL orders.duration HOUR) > NOW()')
            ->join('users', 'ordering_user_id', 'users.id')
            ->first();

        $renting_pending = Order::select(['orders.*', 'users.name', 'users.avatar'])
            ->where('ordering_user_id', $request->user()->id)
            ->where('orders.status', 'pending')
            ->join('users', 'ordered_user_id', 'users.id')
            ->first();

        $rented_pending = Order::select(['orders.*', 'users.name', 'users.avatar'])
            ->where('ordered_user_id', $request->user()->id)
            ->where('orders.status', 'pending')
            ->join('users', 'ordering_user_id', 'users.id')
            ->get();

        return response()->json([
            'renting' => $renting,
            'rented' => $rented,
            'renting_pending' => $renting_pending,
            'rented_pending' => $rented_pending
        ]);
    }
}
