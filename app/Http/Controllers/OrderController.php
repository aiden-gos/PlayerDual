<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $rentService;

    public function __construct()
    {
        $this->rentService = new OrderService();
    }

    public function rent(Request $request)
    {

        $user_id = $request->input('user_id');
        $durationTime = $request->input('time');
        $msg = $request->input('msg');

        return $this->rentService->rent($request, $user_id, $durationTime, $msg);
    }

    public function off(Request $request)
    {
        $user_id = $request->input('user_id');
        $durationTime = $request->input('time');

        return $this->rentService->off($request, $user_id, $durationTime);
    }

    public function acceptRent(Request $request)
    {
        return $this->rentService->acceptRent($request);
    }

    public function rejectRent(Request $request)
    {
        $id = $request->input('id');
        return $this->rentService->rejectRent($request, $id);
    }

    public function endRent(Request $request)
    {
        $id = $request->input('id');
        return $this->rentService->endRent($request, $id);
    }

    public function requestOrder(Request $request)
    {
        return $this->rentService->requestOrder($request);
    }
}
