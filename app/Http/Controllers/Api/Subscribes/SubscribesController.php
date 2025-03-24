<?php

namespace App\Http\Controllers\Api\Subscribes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class SubscribesController extends Controller
{
    public function CheckoutSession(Request $request)
    {
        // dd("test");
        // Set Stripe API Key
        // Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe::setApiKey('sk_test_51R25eNG79v7Vucc9SvJT7rfcWSwdqDQnSNB0BDueKu3mTxM3LbTQ5dgtQtB2sSvkXOTvrtItx6XEJzmQ6BVpz9oH00KtaKB3l0');

        // Define your domain
        $YOUR_DOMAIN = env('APP_URL', 'http://127.0.0.1:8000/');

        try {
            // Retrieve the lookup_key from the request body
            $lookupKey = $request->input('lookup_key');

            // Validasi apakah lookup_key sesuai dengan daftar harga yang tersedia
            // $allowedPrices = [
            //     'price_1R26JEG79v7Vucc9WZggw9sV', // Weekly
            //     'price_1R26TgG79v7Vucc9UShXcRxT', // Monthly
            //     'price_1R26UDG79v7Vucc9EFhos47z'  // Yearly
            // ];

            // if (!in_array($lookupKey, $allowedPrices)) {
            //     return response()->json(['error' => 'Invalid subscription plan selected.'], 400);
            // }

            // Create a Stripe checkout session
            $checkoutSession = Session::create([
                'line_items' => [[
                    'price' => $lookupKey,
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'success_url' => $YOUR_DOMAIN . '/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $YOUR_DOMAIN . '/cancel',
            ]);

            return response()->json(['url' => $checkoutSession->url], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
