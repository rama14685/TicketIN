<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display orders from checkout
     * Admin dapat melihat semua orders yang dibuat dari checkout cart
     */
    public function index()
    {
        // Ambil semua orders dengan relasi user dan details
        $orders = Order::with(['user', 'details.tiket.event'])
            ->latest('order_date')
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display order details
     */
    public function show(Order $order)
    {
        $order->load(['user', 'details.tiket.event']);
        return view('admin.orders.show', compact('order'));
    }
}
