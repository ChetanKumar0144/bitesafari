<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $foods = Food::where('quantity', '>', 0)->get();
        $cart = session('cart', []);

        return view('customer.menu.index', compact('foods', 'cart'));
    }
}

