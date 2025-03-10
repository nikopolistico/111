<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Webhook;

class StripePaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        // Set the Stripe secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a charge (for example, a simple charge of $20)
        try {
            $charge = Charge::create([
                'amount' => 2000,  // Amount in cents (20 dollars)
                'currency' => 'usd',
                'description' => 'Test charge',
                'source' => $request->stripeToken, // Token received from the frontend
            ]);

            return response()->json(['success' => 'Payment successful']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function handleWebhook(Request $request)
    {
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET'); // Set your webhook secret

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid webhook signature'], 400);
        }

        // Handle the event (for example, a successful payment)
        if ($event->type === 'payment_intent.succeeded') {
            $paymentIntent = $event->data->object;
            // Handle the successful payment
        }

        return response()->json(['status' => 'success']);
    }


    public function payment()
    {
        return view('payment');
    }
}
