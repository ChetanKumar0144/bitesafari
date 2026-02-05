<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use Auth;

class CartController extends Controller
{
    /**
     * Show cart (optional, not needed in one-page menu view)
     */

    /**
     * Add item to cart
     */
    public function add(Request $request, $food_id)
    {
        $food = Food::findOrFail($food_id);

        $cart = session()->get('cart', []);

        if(isset($cart[$food_id])){
            $cart[$food_id]['qty']++;
        } else {
            $cart[$food_id] = [
                "food_id" => $food->id,
                "name" => $food->name,
                "price" => $food->price,
                "qty" => 1
            ];
        }

        session()->put('cart', $cart);

        $total = array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['qty']), 0);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'total' => $total
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request, $food_id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$food_id])){
            unset($cart[$food_id]);
            session()->put('cart', $cart);
        }

        $total = array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['qty']), 0);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'total' => $total
        ]);
    }

    /**
     * Increase quantity
     */
    public function increase(Request $request, $food_id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$food_id])){
            $cart[$food_id]['qty']++;
        }

        session()->put('cart', $cart);

        $total = array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['qty']), 0);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'total' => $total
        ]);
    }

    /**
     * Decrease quantity
     */
    public function decrease(Request $request, $food_id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$food_id])){
            $cart[$food_id]['qty']--;

            if($cart[$food_id]['qty'] <= 0){
                unset($cart[$food_id]);
            }
        }

        session()->put('cart', $cart);

        $total = array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['qty']), 0);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'total' => $total
        ]);
    }

    public function index()
    {
        $customer = Auth::user();

        // Cart items ko food aur vendor ke saath load karein
        $cartItems = Cart::where('customer_id', $customer->id)
            ->with('food.vendor')
            ->get();

        $total = 0;
        foreach($cartItems as $item) {
            $total += $item->food->price * $item->quantity;
        }

        return response()->json([
            'success' => true,
            'cart' => $cartItems,
            'total' => $total,
            'count' => $cartItems->sum('quantity')
        ]);
    }

    /**
     * Add or Update item in cart
     */
    public function store(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:food,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $customer = Auth::user();

        // Check if item already exists
        $cart = Cart::updateOrCreate(
            [
                'customer_id' => $customer->id,
                'food_id' => $request->food_id
            ],
            [
                'quantity' => DB::raw('quantity + ' . $request->quantity)
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Bite secured in manifest!',
            'cart_count' => Cart::where('customer_id', $customer->id)->sum('quantity')
        ]);
    }

    /**
     * Remove item
     */
    public function destroy($id)
    {
        Cart::where('customer_id', Auth::id())->where('food_id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
