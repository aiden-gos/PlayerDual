<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
    }

    public function readNotify(Request $request)
    {
        $id = $request->route('id');

        if ($id) {
            $this->notificationService->readNotify($id);
        } else {
            return response()->json(['msg' => 'Read notification failure'], 400);
        }

        return response()->json(['msg' => 'Read notification succesfully'], 200);
    }

    public function readAllNotify(Request $request)
    {
        $result = $request->user()->unreadNotifications->markAsRead();

        if (!$result) {
            return response()->json('Read all notification failure', 400);
        }

        return response()->json(['msg' => 'Read all notification succesfully'], 200);
    }
}
