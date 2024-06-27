<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function __construct()
    {
        //
    }

    public function readNotify($id)
    {
        try {
            DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }
        return true;
    }

    public function readAllNotify($user)
    {
        try {
            $user->unreadNotifications->markAsRead();
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }
        return true;
    }
}
