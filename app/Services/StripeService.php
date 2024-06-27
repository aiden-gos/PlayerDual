<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Webhook;

class StripeService
{
    public function __construct()
    {
        //
    }

    public function paymentMethod($auth_user)
    {
        try {
            $auth_user->createOrGetStripeCustomer();
        } catch (\Throwable $th) {
            Log::error($th);
            return false;
        }
        return true;
    }

    public function checkout($auth_user, $money)
    {
        $money = $money * 100;
        $paymentMethod = $auth_user->defaultPaymentMethod();

        if (empty($paymentMethod) || $money <= 0) {
            $auth_user->createOrGetStripeCustomer();
            return false;
        }

        try {
            $auth_user->invoiceFor('Checkout', $money);
        } catch (\Throwable $th) {
            $strip = new StripeClient();
            $strip->invoces->voidInvoice('id', []);
            return false;
        }

        $auth_user->update(['balance' => ($auth_user->balance + ($money / 100))]);

        return true;
    }

    public function handleWebhook($payload, $sig_header)
    {
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                env('STRIPE_WEBHOOK_SECRET')
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return false;
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return false;
            exit();
        }

        // Handle the event
        if ($event->type == 'invoice.payment_succeeded') {
            $invoice = $event->data->object; // Contains an \Stripe\Invoice
            // Then defined your logic here to handle invoice payment succeeded
        }

        return true;
    }
}
