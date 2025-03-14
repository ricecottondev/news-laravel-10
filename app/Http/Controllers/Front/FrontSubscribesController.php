<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Member as MemberModel;

use App\Models\News;
use Stripe\Stripe;
use Stripe\Price;
use Stripe\Checkout\Session;

class FrontSubscribesController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        // Set Stripe API Key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Define your domain
        $YOUR_DOMAIN = env('APP_URL', 'http://127.0.0.1:8000/');

        try {
            // Retrieve the lookup_key from the request body
            $lookupKey = $request->input('lookup_key');

            // Fetch price details based on lookup_key
            $prices = Price::all([
                'lookup_keys' => [$lookupKey],
                'expand' => ['data.product']
            ]);

            // dd($prices);

            // Create a Stripe checkout session
            $checkoutSession = Session::create([
                'line_items' => [[
                    'price' => 'price_1R26JEG79v7Vucc9WZggw9sV',
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'success_url' => $YOUR_DOMAIN . '/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $YOUR_DOMAIN . '/cancel',
            ]);

            return redirect($checkoutSession->url, 303);
        } catch (\Exception $e) {
            return redirect(route('cancel.page'))->with('error', $e->getMessage());
        }
    }
}
