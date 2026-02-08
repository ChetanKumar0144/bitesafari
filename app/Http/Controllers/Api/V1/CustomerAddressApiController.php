<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;

class CustomerAddressApiController extends Controller
{
    /**
     * List all addresses for authenticated customer
     */
    public function index()
    {
        $customer = Auth::guard('sanctum')->user();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'data' => null,
            ], 401);
        }

        $addresses = CustomerAddress::where('customer_id', $customer->id)
            ->orderByDesc('is_default')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Addresses retrieved successfully',
            'data' => $addresses
        ], 200);
    }

    /**
     * Store a new address
     */
    public function store(Request $request)
    {
        $customer = Auth::guard('sanctum')->user();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'data' => null,
            ], 401);
        }

        $messages = [
            'label.max' => 'Address label (e.g., Home/Office) is too long. Keep it under 50 characters.',

            'address_line1.required' => 'Street address or House number is required.',
            'address_line1.max' => 'Address Line 1 is too long.',

            'city.required' => 'Please enter your City.',
            'state.required' => 'Please enter your State.',

            'postal_code.required' => 'ZIP/Postal code is missing.',
            'postal_code.max' => 'Please enter a valid Postal code.',

            'is_default.boolean' => 'Invalid value for default address setting.',
        ];

        $validated = $request->validate([
            'label' => 'nullable|string|max:50',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:100',
            'is_default' => 'nullable|boolean',
        ], $messages);

        // Reset default address if new one is default
        if (!empty($validated['is_default']) && $validated['is_default']) {
            CustomerAddress::where('customer_id', $customer->id)
                ->update(['is_default' => false]);
        }

        $address = CustomerAddress::create([
            'customer_id' => $customer->id,
            'label' => $validated['label'] ?? 'Home',
            'address_line1' => $validated['address_line1'],
            'address_line2' => $validated['address_line2'] ?? null,
            'city' => $validated['city'],
            'state' => $validated['state'],
            'postal_code' => $validated['postal_code'],
            'country' => $validated['country'] ?? 'India',
            'is_default' => $validated['is_default'] ?? false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address saved successfully',
            'data' => $address
        ], 201);
    }

    /**
     * Optional: Delete an address
     */
    public function destroy($id)
    {
        $customer = Auth::guard('sanctum')->user();

        $address = CustomerAddress::where('customer_id', $customer->id)
            ->where('id', $id)
            ->first();

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found',
            ], 404);
        }

        $address->delete();

        return response()->json([
            'success' => true,
            'message' => 'Address deleted successfully'
        ], 200);
    }

    /**
     * Optional: Update an address
     */
    public function update(Request $request, $id)
    {
        $customer = Auth::guard('sanctum')->user();

        $address = CustomerAddress::where('customer_id', $customer->id)
            ->where('id', $id)
            ->first();

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found',
            ], 404);
        }

        $messages = [
            'label.max' => 'The label (e.g. Home, Work) cannot exceed 50 characters.',

            'address_line1.max' => 'Address Line 1 is too long (Max 255 chars).',
            'address_line2.max' => 'Address Line 2 is too long (Max 255 chars).',

            'city.max' => 'City name is too long.',
            'state.max' => 'State name is too long.',

            'postal_code.max' => 'Postal code cannot be more than 20 characters.',
            'country.max' => 'Country name is too long.',

            'is_default.boolean' => 'Please provide a valid true or false value for default address.',
        ];

        $validated = $request->validate([
            'label' => 'nullable|string|max:50',
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'is_default' => 'nullable|boolean',
        ], $messages);

        // Reset default if needed
        if (!empty($validated['is_default']) && $validated['is_default']) {
            CustomerAddress::where('customer_id', $customer->id)
                ->update(['is_default' => false]);
        }

        $address->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Address updated successfully',
            'data' => $address
        ], 200);
    }
}
