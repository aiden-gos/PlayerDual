<?php

namespace App\Http\Controllers;

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
        $duration = $request->input('time');
        $msg = $request->input('msg');
        $auth_user = $request->user();

        if (!$user_id || !$duration) {
            return redirect()->back()->with('error', 'Bad Requests.');
        }

        $result = $this->rentService->rent($auth_user, $user_id, $duration, $msg);

        if (!$result) {
            return redirect()->back()->with('error', 'Order failure.');
        }

        return redirect()->back()->with('success', 'Order successfully.');
    }

    public function off(Request $request)
    {
        $user_id = $request->input('user_id');
        $duration = $request->input('time');

        if (!$user_id || !$duration) {
            return redirect()->back()->with('error', 'Bad Requests.');
        }

        $result = $this->rentService->off($request, $user_id, $duration);

        if (!$result) {
            return redirect()->back()->with('error', 'Offline failure.');
        }

        return redirect()->back()->with('success', 'Offline successfully.');
    }

    public function acceptRent(Request $request)
    {
        $order_id = $request->input('id');
        if (!$order_id) {
            return redirect()->back()->with('error', 'Bad Requests.');
        }

        $result = $this->rentService->acceptRent($order_id);

        if (!$result) {
            return redirect()->back()->with('error', 'Accept order failure.');
        }

        return redirect()->back()->with('success', 'Accept order successfully.');
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
        if (!$order_id) {
            return redirect()->back()->with('error', 'Bad Requests.');
        }

        $result = $this->rentService->endRent($order_id);

        if (!$result) {
            return redirect()->back()->with('error', 'Reject order failure.');
        }

        return redirect()->back()->with('success', 'Reject order successfully.');
    }

    public function requestOrder(Request $request)
    {
        $auth_user_id = $request->user()->id;
        $data = $this->rentService->requestOrder($auth_user_id);

        return response()->json($data);
    }

    public function listRequest(Request $request)
    {
        return view('request.request-order');
    }
}
