<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\BillingPortal\Session;

class StripeController extends Controller
{
    public function billingPortal(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'customer' => 'cus_xxxx', // Replace with the actual Stripe customer ID
            'return_url' => route('home'),
        ]);

        return redirect($session->url);
    }
}
