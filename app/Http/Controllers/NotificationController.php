<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function readNotify(Request $request)
    {
        try {
            $id = $request->route('id');

            if ($id) {
                DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
            }
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function readAllNotify(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();
        return response()->json('Read all notification ok', 200);
    }
}
