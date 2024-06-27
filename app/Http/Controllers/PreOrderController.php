<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\PreOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $duration = $request->input('time');
        $msg = $request->input('msg');
        $auth_user = $request->user();


        if (!$user_id || !$duration) {
            return redirect()->back()->with('error', 'Bad Requests.');
        }
        $result = $this->rentService->preOrder($auth_user, $user_id, $duration, $msg);

        if (!$result) {
            return redirect()->back()->with('error', 'Pre-rder failure.');
        }

        return redirect()->back()->with('success', 'Pre-order successfully.');
    }

    public function acceptRent(Request $request)
    {
        $order_id = $request->input('id');
        if (!$order_id) {
            return redirect()->back()->with('error', 'Bad Requests.');
        }

        $result = $this->rentService->acceptRent($order_id);

        if (!$result) {
            return redirect()->back()->with('error', 'Accept pre-order failure.');
        }

        return redirect()->back()->with('success', 'Accept pre-order successfully.');
    }

    public function rejectRent(Request $request)
    {
        $order_id = $request->input('id');

        if (!$order_id) {
            return redirect()->back()->with('error', 'Bad Requests.');
        }
        $result = $this->rentService->rejectRent($order_id);

        if (!$result) {
            return redirect()->back()->with('error', 'Reject order failure.');
        }

        return redirect()->back()->with('success', 'Reject order successfully.');
    }

    public function endRent(Request $request)
    {
        $order_id = $request->input('id');
        $auth_user = $request->user();

        if (!$order_id) {
            return redirect()->back()->with('error', 'Bad Requests.');
        }

        $result = $this->rentService->endPreOrder($auth_user, $order_id);

        if (!$result) {
            return redirect()->back()->with('error', 'Reject order failure.');
        }

        return redirect()->back()->with('success', 'Reject order successfully.');
    }

    public function requestPreOrder(Request $request)
    {
        $auth_user = $request->user();
        $data = $this->rentService->requestPreOrder($auth_user);

        return response()->json($data);
    }
}
