<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerCartApiController extends Controller
{
    /**
     * Authenticated Customer ka Cart fetch karna
     */
    public function index()
    {
        $customer = Auth::guard('sanctum')->user();
        if (!$customer) return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);

        $cartItems = Cart::where('customer_id', $customer->id)
            ->with(['food' => function($q) {
                $q->select('id', 'name', 'price', 'image', 'vendor_id');
            }])
            ->get();

        $subtotal = $cartItems->sum(function($item) {
            return $item->food->price * $item->quantity;
        });

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $cartItems,
                'summary' => [
                    'subtotal' => (float)$subtotal,
                    'count' => $cartItems->sum('quantity')
                ]
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $customer = Auth::guard('sanctum')->user();
        if (!$customer) return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);


        $request->validate([
            'food_id' => 'required|exists:food,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Logic: Agar item pehle se hai toh plus karo, nahi toh naya banao
        $cart = Cart::updateOrCreate(
            ['customer_id' => $customer->id, 'food_id' => $request->food_id],
            ['quantity' => DB::raw('quantity + ' . $request->quantity)]
        );

        return response()->json([
            'success' => true,
            'message' => 'Bite added to safari cart',
            'cart_count' => Cart::where('customer_id', $customer->id)->sum('quantity')
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $customer = Auth::guard('sanctum')->user();
        if (!$customer) return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);

        $request->validate(['quantity' => 'required|integer|min:1']);

        $cartItem = Cart::where('customer_id', $customer->id)->findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json(['success' => true, 'message' => 'Quantity updated']);
    }

    public function destroy($id)
    {
        $customer = Auth::guard('sanctum')->user();
        if (!$customer) return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);

        Cart::where('customer_id', $customer->id)->where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => 'Item removed from manifest']);
    }

    public function clear()
    {
        $customer = Auth::guard('sanctum')->user();
        if (!$customer) return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);

        Cart::where('customer_id', $customer->id)->delete();
        return response()->json(['success' => true, 'message' => 'Cart cleared']);
    }

    public function decrement(Request $request, $id)
    {
        $customer = Auth::guard('sanctum')->user();

        // Cart item dhoondo jo is customer ka ho
        $cartItem = Cart::where('customer_id', $customer->id)->where('id', $id)->first();

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Item not found'], 404);
        }

        if ($cartItem->quantity > 1) {
            // Quantity ek kam karo
            $cartItem->decrement('quantity');
            $message = "Quantity decreased";
        } else {
            // Agar 1 hi bacha hai aur user minus kare, toh item uda do
            $cartItem->delete();
            $message = "Item removed from safari manifest";
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'cart_count' => Cart::where('customer_id', $customer->id)->sum('quantity')
        ]);
    }
}
