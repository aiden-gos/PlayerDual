<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StripeService;
use Illuminate\Support\Facades\Redirect;

class StripeController extends Controller
{
    protected $stripeService;

    public function __construct()
    {
        $this->stripeService = new StripeService();
    }

    public function paymentMethod(Request $request)
    {
        $this->stripeService->paymentMethod($request);

        return $request->user()->redirectToBillingPortal(route('profile.payment'));
    }

    public function checkout(Request $request)
    {
        $auth_user = $request->user();
        $request->validate([
            'money' => 'required|min:1',
        ]);
        $money = $request->input('money');

        $result = $this->stripeService->checkout($auth_user, $money);

        if (!$result) {
            return $auth_user->redirectToBillingPortal(route('profile.payment'));
        }

        return Redirect::route("home")->with('status', 'checkout-ok');
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('stripe-signature');

        $result = $this->stripeService->handleWebhook($payload, $sig_header);

        if (!$result) {
            return response()->status(400);
        }
        return response()->status(200);
    }
}
