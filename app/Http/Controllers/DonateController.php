<?php

namespace App\Http\Controllers;

use App\Events\ActionNotify as EventsActionNotify;
use App\Events\EventActionNotify;
use App\Models\Donate;
use App\Models\User;
use App\Notifications\ActionNotify;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;

class DonateController extends Controller
{
    public function donate(Request $request)
    {
        $money = $request->input('money');
        $user_id = $request->input('user_id');
        $msg = $request->input('msg');

        if($request->user()->balance >= $money){
            try {
                DB::beginTransaction();
                $request->user()->update(['balance' => ($request->user()->balance - $money)]);
                $re_user = User::find(['id' => $user_id])->first();
                $re_user->update(['balance' => ($re_user->balance + $money)]);

                Donate::create([
                    'donating_user_id' => $request->user()->id,
                    'donated_user_id' => $re_user->id,
                    'message' => $msg,
                    'price' => $money
                ]);
                //Save to database
                $re_user->notify(new ActionNotify([$request->user()->name . " donated $" .$money]));
                $request->user()->notify(new ActionNotify(["Donated $" .$money . " for " . $re_user->name]));
                //Realtime notification
                event(new EventActionNotify($re_user->id, $request->user()->name . " donated $" .$money ));
                // event(new EventActionNotify($request->user()->id, "Donated $" .$money . " for " . $re_user->name ));

                DB::commit();
            } catch (\PDOException $e) {
                DB::rollBack();
                Log::debug($e);
            }
        }
        return Redirect::back();

    }
}
