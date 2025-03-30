<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class SubscriptionController extends Controller
{
    public function show()
{
    $user = auth()->user();

    // Verificar si tiene una fecha de suscripción y si es futura
    $subscriptionEnd = $user->subscription_ends_at
        ? \Carbon\Carbon::parse($user->subscription_ends_at)
        : null;

    $alreadySubscribed = $subscriptionEnd && $subscriptionEnd->isFuture();
    $remainingDays = $alreadySubscribed ? now()->diffInDays($subscriptionEnd, false) : 0;

    return view('subscribe', [
        'alreadySubscribed' => $alreadySubscribed,
        'subscriptionEnd' => $subscriptionEnd,
        'remainingDays' => $remainingDays,
    ]);
}


    public function checkout(Request $request)
    {
        $user = auth()->user();
        $months = (int) $request->plan;

        $prices = [
            1 => 300,
            3 => 600,
            6 => 1000,
            12 => 1400,
        ];

        $amount = $prices[$months] ?? 300;

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => "$months mes(es) de suscripción",
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('subscribe.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}&months=$months",
            'cancel_url' => route('subscribe'),
            'customer_email' => $user->email,
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $session_id = $request->get('session_id');
        $months = (int) $request->get('months');

        if (!$session_id || !$months) {
            abort(403);
        }

        $user = auth()->user();

        // Marcar como suscrito
        $user->subscriber = 1;
        $current = $user->subscription_ends_at;

if ($current && \Carbon\Carbon::parse($current)->isFuture()) {
    // Si ya tiene una suscripción activa, suma los meses a la fecha actual
    $user->subscription_ends_at = \Carbon\Carbon::parse($current)->addMonths($months);
} else {
    // Si no tiene suscripción o está vencida, empieza desde ahora
    $user->subscription_ends_at = now()->addMonths($months);
}

        $user->save();

        return view('subscribe_success', ['months' => $months]);
    }
}
