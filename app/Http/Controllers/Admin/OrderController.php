<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $orders = Order::when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // important for pagination + filter

        return view('admin.orders.index', compact('orders', 'status'));
    }

    public function show($id)
    {
        // Admin saare vendors aur items dekh sakta hai
        $order = Order::with([
            'items.food',
            'vendors.vendor', // Taaki dikhe kaunsa vendor hai
            'payment',
            'customer'
        ])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,preparing,delivered,cancelled',
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Order status updated successfully');
    }

    public function pending()
    {
        $orders = Order::where('status', 'pending')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function completed()
    {
        $orders = Order::where('status', 'completed')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function delivered()
    {
        $orders = Order::where('status', 'delivered')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
}

