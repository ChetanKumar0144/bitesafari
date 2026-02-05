<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class OrderPlaceController extends Controller
{
    public function checkout()
    {
        $cartItems = session('cart', []);
        return view('customer.checkout', compact('cartItems'));
    }

    
    public function store(Request $request)
    {
        $customer = auth('customer')->user();
        $cart = session('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->route('customer.menu');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        // 1️⃣ Create Order
        $order = Order::create([
            'customer_id' => $customer->id,
            'order_no' => 'ORD-' . strtoupper(Str::random(6)),
            'status' => 'pending',
            'total_amount' => $total,
            'address' => $request->address ?? 'N/A',
        ]);

        // 2️⃣ Create Order Items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $item['food_id'],
                'food_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
            ]);
        }

        // 3️⃣ Clear Cart
        session()->forget('cart');

        return redirect()
            ->route('customer.orders.show', $order->id)
            ->with('success', 'Order placed successfully 🎉');
    }
}

