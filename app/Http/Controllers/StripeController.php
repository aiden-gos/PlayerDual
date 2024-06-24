<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Webhook;

class StripeController extends Controller
{
    public function paymentMethod(Request $request)
    {
        $stripeCustomer = $request->user()->createOrGetStripeCustomer();
        return $request->user()->redirectToBillingPortal(route('profile.payment'));
    }

    public function checkout(Request $request)
    {
        $money = $request->input('money') * 100;
        $paymentMethod = $request->user()->defaultPaymentMethod();

        if (empty($paymentMethod)) {
            // return Redirect::route("profile.edit")->with('status', 'checkout-fail-1');
            $request->user()->createOrGetStripeCustomer();
            return $request->user()->redirectToBillingPortal(route('profile.payment'));
        } elseif ($money <= 0) {
            // return Redirect::route("profile.edit")->with('status', 'checkout-fail-2');
            return $request->user()->redirectToBillingPortal(route('profile.payment'));
        }

        $user =  $request->user();
        try {
            $user->invoiceFor('Checkout', $money);
        } catch (\Throwable $th) {
            return $request->user()->redirectToBillingPortal(route('profile.payment'));
            $strip = new StripeClient();
            $strip->invoces->voidInvoice('id', []);
        }

        $user->update(['balance' => ($user->balance + ($money / 100))]);
        return Redirect::route("home")->with('status', 'checkout-ok');
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('stripe-signature');
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                env('STRIPE_WEBHOOK_SECRET')
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        // Handle the event
        if ($event->type == 'invoice.payment_succeeded') {
            $invoice = $event->data->object; // Contains an \Stripe\Invoice
            // Then defined your logic here to handle invoice payment succeeded
        }

        http_response_code(200);
    }
}
