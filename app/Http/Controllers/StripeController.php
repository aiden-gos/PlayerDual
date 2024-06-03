<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StripeController extends Controller
{
    public function paymentMethod(Request $request)
    {
        $stripeCustomer = $request->user()->createOrGetStripeCustomer();
        return $request->user()->redirectToBillingPortal( route('profile.payment'));
    }

    public function checkout(Request $request)
    {
        $money = $request->input('money') * 100;
        $paymentMethod = $request->user()->defaultPaymentMethod();

        if(empty($paymentMethod) || $money <= 0 ){
            return Redirect::route("profile.edit")->with('status', 'checkout-fail');;
        }

        $request->user()->invoiceFor('Checkout', $money);
        return Redirect::route("profile.edit")->with('status', 'checkout-ok');;
    }
}
