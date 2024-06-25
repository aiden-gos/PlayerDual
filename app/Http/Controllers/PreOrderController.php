<?php

namespace App\Http\Controllers;

use App\Services\PreOrderService;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    protected $rentService;

    public function __construct()
    {
        $this->rentService = new PreOrderService();
    }

    public function preOrder(Request $request)
    {
        $user_id = $request->input('user_id');
        $durationTime = $request->input('time');
        $msg = $request->input('msg');

        return $this->rentService->preOrder($request, $user_id, $durationTime, $msg);
    }

    public function acceptRent(Request $request)
    {
        $id = $request->input('id');

        return $this->rentService->acceptRent($request, $id);
    }

    public function rejectRent(Request $request)
    {
        $id = $request->input('id');

        return $this->rentService->rejectRent($request, $id);
    }

    public function endRent(Request $request)
    {
        $id = $request->input('id');

        $this->rentService->endRent($request, $id);
    }
}
