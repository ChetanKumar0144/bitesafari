<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Models\Food;
use App\Models\Payment;
use App\Models\OrderVendor;
use App\Models\CustomerAddress;

class CustomerOrderApiController extends Controller
{
    /**
     * List all orders for authenticated customer
     */
    public function index()
    {
        $customer = Auth::guard('sanctum')->user();

        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        $orders = Order::where('customer_id', $customer->id)
            ->with(['items.food', 'payment', 'vendors.vendor'])
            ->orderByDesc('created_at')
            ->get();

        $formattedOrders = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'order_no' => $order->order_no,
                'status' => $order->status,
                'created_at' => $order->created_at->format('d M Y, h:i A'),
                'shipping' => [
                    'label' => $order->label,
                    'address' => $order->address_line1 . ($order->address_line2 ? ', ' . $order->address_line2 : ''),
                    'city' => $order->city,
                    'pincode' => $order->postal_code
                ],
                'billing' => [
                    'subtotal' => (float) ($order->payment?->subtotal ?? 0),
                    'gst' => (float) ($order->payment?->gst_amount ?? 0),
                    'delivery' => (float) ($order->payment?->delivery_charge ?? 0),
                    'total' => (float) ($order->payment?->total_amount ?? $order->total_amount),
                    'method' => strtoupper($order->payment?->payment_method ?? 'N/A'),
                    'status' => $order->payment?->payment_status ?? 'unknown'
                ],
                'items' => $order->items->map(function ($item) {
                    return [
                        'name' => $item->food_name,
                        'qty' => $item->quantity,
                        'price' => (float) $item->price,
                        'subtotal' => (float) ($item->price * $item->quantity)
                    ];
                }),
                // Vendors details
                'vendors' => $order->vendors->map(function ($v) {
                    return [
                        'name' => $v->vendor?->name ?? 'Unknown Vendor',
                        'status' => $v->status
                    ];
                })
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Orders retrieved successfully',
            'data' => $formattedOrders
        ], 200);
    }

    /**
     * Create a new order
     */
    public function store(Request $request)
    {
        $customer = Auth::guard('sanctum')->user();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'data' => []
            ], 401);
        }

        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.food_id' => 'required|integer|exists:food,id',
            'items.*.quantity' => 'required|integer|min:1',
            'address_id' => 'required|integer|exists:customer_addresses,id',
            'payment_method' => 'required|string|in:cod,online',
        ]);

        DB::beginTransaction();

        try {
            // ✅ Address check
            $address = CustomerAddress::where('id', $validated['address_id'])
                ->where('customer_id', $customer->id)
                ->first();

            if (!$address) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid address',
                    'data' => []
                ], 422);
            }

            // ✅ Create MAIN ORDER
            $order = Order::create([
                'order_no' => 'ORD-' . time(),
                'customer_id' => $customer->id,
                'total_amount' => 0,
                'status' => 'pending',

                'label' => $address->label,
                'address_line1' => $address->address_line1,
                'address_line2' => $address->address_line2,
                'city' => $address->city,
                'state' => $address->state,
                'postal_code' => $address->postal_code,
                'country' => $address->country,
            ]);

            // 🔥 STEP 1: Group items by vendor
            $groupedByVendor = [];

            foreach ($validated['items'] as $item) {
                $food = Food::with('vendor')->findOrFail($item['food_id']);

                $groupedByVendor[$food->vendor_id][] = [
                    'food' => $food,
                    'quantity' => $item['quantity']
                ];
            }

            $orderSubTotal = 0;

            // 🔥 STEP 2: Create vendor orders + items
            foreach ($groupedByVendor as $vendorId => $items) {

                $vendorTotal = 0;

                $orderVendor = OrderVendor::create([
                    'order_id' => $order->id,
                    'vendor_id' => $vendorId,
                    'vendor_total' => 0,
                    'status' => 'pending'
                ]);

                foreach ($items as $item) {
                    $food = $item['food'];
                    $qty  = $item['quantity'];

                    OrderItem::create([
                        'order_id' => $order->id,
                        'vendor_id' => $orderVendor->id,
                        'vendor_id' => $vendorId,
                        'food_id' => $food->id,
                        'food_name' => $food->name,
                        'price' => $food->price,
                        'quantity' => $qty,
                    ]);

                    $vendorTotal += $food->price * $qty;
                }

                $orderVendor->update(['vendor_total' => $vendorTotal]);
                $orderSubTotal += $vendorTotal;
            }

            // ✅ Update order total
            $order->update(['total_amount' => $orderSubTotal]);

            // 💰 Payment
            $gst = round($orderSubTotal * 0.09, 2);
            $deliveryCharge = 40;
            $tip = $request->tip_amount ?? 0;
            $grandTotal = $orderSubTotal + $gst + $deliveryCharge + $tip;

            Payment::create([
                'order_id' => $order->id,
                'subtotal' => $orderSubTotal,
                'gst_amount' => $gst,
                'delivery_charge' => $deliveryCharge,
                'tip_amount' => $tip,
                'total_amount' => $grandTotal,
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Multi-vendor order created',
                'data' => $order->load('vendors.items')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

}
