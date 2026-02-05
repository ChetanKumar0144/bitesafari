<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;

class CustomerAddressController extends Controller
{
    // List all addresses
    public function index()
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
            ], 401);
        }

        $addresses = CustomerAddress::where('customer_id', $customer->id)->get();

        return response()->json([
            'success' => true,
            'data' => $addresses
        ]);
    }


    // Store new address
    public function store(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'label' => 'nullable|string|max:50',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:100',
            'is_default' => 'nullable|boolean',
        ]);

        // If default, reset other addresses
        if(!empty($validated['is_default']) && $validated['is_default']) {
            CustomerAddress::where('customer_id', $customer->id)
                ->update(['is_default' => false]);
        }

        $address = CustomerAddress::create(array_merge($validated, [
            'customer_id' => $customer->id,
            'country' => $validated['country'] ?? 'India'
        ]));

        return response()->json([
            'success' => true,
            'data' => $address,
            'message' => 'Address saved successfully'
        ]);
    }
}

