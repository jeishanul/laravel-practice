<?php

namespace App\Http\Controllers;

use App\Enum\PaymentStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;

class PaymentController extends Controller
{
    public function process(Order $order)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $checkoutSession = CheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Order No #' . $order->invoice_number,
                    ],
                    'unit_amount' => $order->total * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', $order->id),
            'cancel_url' => route('payment.cancel', $order->id),
        ]);

        return redirect($checkoutSession->url);
    }

    public function success(Order $order)
    {
        $order->update(['payment_status' => PaymentStatus::Paid->value]);
        return to_route('orders.index');
    }

    public function cancel()
    {
        return to_route('orders.index');
    }
}
