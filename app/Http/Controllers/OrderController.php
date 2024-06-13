<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->paginate(10);
        return view('order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'user.details', 'details', 'details.product');
        return view('order.show', compact('order'));
    }
}
