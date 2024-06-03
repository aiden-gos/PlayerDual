<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
                Log::debug("Da Chuyen Money");

                Donate::create([
                    'donating_user_id' => $request->user()->id,
                    'donated_user_id' => $re_user->id,
                    'message' => $msg,
                    'price' => $money
                ]);
                DB::commit();
            } catch (\PDOException $e) {
                DB::rollBack();
                Log::debug($e);
            }
        }
        return Redirect::back();

    }
}
