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

    public function preOrder($auth_user, $user_id, $durationTime, $msg)
    {
        $user_ordered = User::find(['id' => $user_id])->first();

        $cost = $user_ordered->price * $durationTime;

        if (self::checkUserBalance($auth_user, $cost)) {
            try {
                $order = Order::create([
                    'ordering_user_id' => $auth_user->id,
                    'ordered_user_id' => $user_ordered->id,
                    'message' => $msg,
                    'status' => 'pre-ordering',
                    'price' => $user_ordered->price,
                    'duration' => $durationTime,
                    'total_price' => $cost,
                ]);

                $user_ordered->notify(new ActionNotify([$auth_user->name . " pre-order you now"]));
                $user_ordered->notify(new RentNotify($auth_user->id, $auth_user->name));
                //Realtime notification

                event(new EventActionNotify($user_ordered->id, $auth_user->name . " pre-order you now"));
                event(new EventActionNotify($user_ordered->id . '-pre-order', [
                    'preOrder' => $order,
                    'user' => $auth_user
                ]));
            } catch (\Throwable $th) {
                Log::error($th);
                return false;
            }
        }

        return true;
    }

    public function acceptRent($id)
    {
        DB::beginTransaction();

        try {
            $order = Order::find(['id' => $id])->first();
            $currentOrder = Order::where('ordered_user_id', $order->ordered_user_id)
                ->where('status', 'accepted')->first();
            $order->update([
                'status' => 'pre-ordered',
                'start_at' => $currentOrder->end_at,
                'end_at' => date(
                    'Y-m-d H:i:s',
                    strtotime($currentOrder->end_at . ' + ' . $order->duration . ' hours')
                )
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
            return false;
        }
        return true;
    }

    public function rejectRent($id)
    {
        DB::beginTransaction();
        try {
            $order = Order::find(['id' => $id])->first();

            $order->update([
                'status' => 'rejected'
            ]);

            event(new EventActionNotify($order->ordering_user_id . '-pre-order-request', ['order' => $order]));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return false;
        }

        return true;
    }

    public function endPreOrder($auth_user, $id)
    {
        DB::beginTransaction();
        try {
            if (!empty($id)) {
                $order = Order::find(['id' => $id, 'status' => 'accepted'])->first();

                if ($auth_user->id == $order->ordered_user_id) {
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
            return false;
        }

        return true;
    }

    private function checkUserBalance($auth_user, $cost)
    {
        if ($auth_user->balance < $cost) {
            return false;
        }
        return true;
    }

    public function requestPreOrder($auth_user)
    {
        $renting = Order::select(['orders.*', 'users.name', 'users.avatar'])
            ->where('ordering_user_id', $auth_user->id)
            ->where('orders.status', 'pre-ordered')
            ->join('users', 'ordered_user_id', 'users.id')
            ->first();

        $rented = Order::select(['orders.*', 'users.name', 'users.avatar'])
            ->where('ordered_user_id', $auth_user->id)
            ->where('orders.status', 'pre-ordered')
            ->join('users', 'ordering_user_id', 'users.id')
            ->first();

        $renting_pending = Order::select(['orders.*', 'users.name', 'users.avatar'])
            ->where('ordering_user_id', $auth_user->id)
            ->where('orders.status', 'pre-ordering')
            ->join('users', 'ordered_user_id', 'users.id')
            ->first();

        $rented_pending = Order::select(['orders.*', 'users.name', 'users.avatar'])
            ->where('ordered_user_id', $auth_user->id)
            ->where('orders.status', 'pre-ordering')
            ->join('users', 'ordering_user_id', 'users.id')
            ->get();

        self::calculateSecondsToStart($renting);
        self::calculateSecondsToStart($rented);

        return [
            'renting' => $renting,
            'rented' => $rented,
            'renting_pending' => $renting_pending,
            'rented_pending' => $rented_pending
        ];
    }

    private function calculateSecondsToStart($order)
    {
        if ($order && isset($order->start_at)) {
            $startAt = new \DateTime($order->start_at);
            $now = new \DateTime();
            $diff = $now->diff($startAt);

            // Calculate the total number of seconds
            $secondsToStart = ($diff->invert == 0 ? 1 : -1) * ( // Check if the date is in the past
                ($diff->days * 24 * 60 * 60) + // Days to seconds
                ($diff->h * 60 * 60) +         // Hours to seconds
                ($diff->i * 60) +              // Minutes to seconds
                $diff->s                       // Seconds
            );
            $order->seconds_until_end = $secondsToStart;
        }
    }
}
