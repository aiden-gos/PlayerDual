<?php

namespace App\Services;

use App\Events\EventActionNotify;
use App\Models\Donate;
use App\Models\User;
use App\Notifications\ActionNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class DonateService
{
    public function __construct()
    {
        //
    }

    public function donate($auth_user, $money, $msg, $user_id)
    {
        if ($auth_user->balance >= $money && $money > 0) {
            try {
                DB::beginTransaction();
                $auth_user->update(['balance' => ($auth_user->balance - $money)]);
                $re_user = User::find(['id' => $user_id])->first();
                $re_user->update(['balance' => ($re_user->balance + $money)]);

                Donate::create([
                    'donating_user_id' => $auth_user->id,
                    'donated_user_id' => $re_user->id,
                    'message' => $msg,
                    'price' => $money
                ]);
                //Save to database
                $re_user->notify(new ActionNotify([$auth_user->name . " donated $" . $money]));
                $auth_user->notify(new ActionNotify(["Donated $" . $money . " for " . $re_user->name]));
                //Realtime notification
                event(new EventActionNotify($re_user->id, $auth_user->name . " donated $" . $money));
                // event(new EventActionNotify($request->user()->id, "Donated $" .$money . " for " . $re_user->name ));

                DB::commit();
            } catch (\PDOException $e) {
                DB::rollBack();
                Log::error($e);
                return false;
            }

            return true;
        }
    }
}
