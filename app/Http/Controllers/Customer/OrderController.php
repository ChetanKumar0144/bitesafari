<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Customer order list
     */

    public function placeOrder(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
        ]);

        $cart = session('cart', []);

        if (count($cart) === 0) {
            return redirect()
                ->route('customer.menu')
                ->with('error', 'Your cart is empty');
        }

        DB::beginTransaction();
        // try {
            // 🔹 Create Order
            $order = Order::create([
                'order_no'     => 'ORD-' . time(),
                'customer_id'      => Auth::guard('customer')->id(),
                'total_amount' => 0,
                'status'       => 'pending',
                'address'      => $request->address,
            ]);

            $total = 0;

            // 🔹 Order Items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'food_id'  => $item['food_id'],
                    'customer_id'=> Auth::guard('customer')->id(),
                    'food_name'=> $item['name'],
                    'name'=> $item['name'],
                    'price'    => $item['price'],
                    'quantity' => $item['qty'],
                ]);

                $total += $item['price'] * $item['qty'];
            }

            // 🔹 Update total
            $order->update(['total_amount' => $total]);

            // 🔹 Clear cart
            session()->forget('cart');

            DB::commit();

            return redirect()
                ->route('customer.orders')
                ->with('success', 'Order placed successfully 🎉');

        // } catch (\Exception $e) {
        //     DB::rollBack();

        //     return back()->with('error', 'Something went wrong!');
        // }
    }

    public function index()
    {
        $orders = Order::where('customer_id', Auth::guard('customer')->id())
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // security check
        if ($order->customer_id !== Auth::guard('customer')->id()) {
            abort(403);
        }

        return view('customer.orders.show', compact('order'));
    }
}
