<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Webhook;
use App\Services\StripeService;

class StripeController extends Controller
{   
    protected $stripeService;

    public function __construct()
    {
        $this->stripeService = new StripeService();
    }

    public function paymentMethod(Request $request)
    {
        return $this->stripeService->paymentMethod($request);
    }

    public function checkout(Request $request)
    {
        return $this->stripeService->checkout($request);
    }

    public function handleWebhook(Request $request)
    {
        return $this->stripeService->handleWebhook($request);
    }
}
