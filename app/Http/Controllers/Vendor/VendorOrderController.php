<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderVendor;

class VendorOrderController extends Controller
{
    public function index(Request $request)
    {
        $vendor = Auth::guard('vendor')->user();
        $status = $request->query('status');

        $orders = Order::whereHas('items', function ($q) use ($vendor) {
                $q->where('vendor_id', $vendor->id);
            })
            ->when($status, function ($q) use ($status) {
                return $q->where('status', $status);
            })
            ->with([
                'items' => function ($q) use ($vendor) {
                    $q->where('vendor_id', $vendor->id)->with('food');
                }
            ])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('vendor.orders.index', compact('orders', 'status'));
    }
    public function show($id)
    {
        $vendor = Auth::guard('vendor')->user();

        // 1. Check karo ki ye order is vendor ka hai ya nahi
        $order = Order::whereHas('items', function ($q) use ($vendor) {
                $q->where('vendor_id', $vendor->id);
            })
            ->with([
                'items' => function ($q) use ($vendor) {
                    // Sirf is vendor ke items load karo
                    $q->where('vendor_id', $vendor->id)->with('food');
                },
                'payment' // Payment details ke liye
            ])
            ->findOrFail($id);

        return view('vendor.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $orderId)
    {
        $vendor = Auth::guard('vendor')->user();

        $request->validate([
            'status' => 'required|in:pending,accepted,preparing,delivered,cancelled',
        ]);

        // 1. Find specific vendor's portion
        $vendorOrder = OrderVendor::where('order_id', $orderId)
            ->where('vendor_id', $vendor->id)
            ->firstOrFail();

        DB::beginTransaction();
        try {
            // 2. Update Vendor's specific status
            $vendorOrder->update(['status' => $request->status]);

            // 3. Sync with Main Order
            $mainOrder = Order::findOrFail($orderId);

            if ($request->status == 'accepted' && $mainOrder->status == 'pending') {
                $mainOrder->update(['status' => 'accepted']);
            }

            // Logic: Agar ye vendor "delivered" kar raha hai, check karo baki vendors ka kya status hai
            if ($request->status == 'delivered') {
                $remainingVendors = OrderVendor::where('order_id', $orderId)
                    ->where('status', '!=', 'delivered')
                    ->count();

                // Agar koi aur vendor baki nahi hai, toh main order bhi delivered
                if ($remainingVendors == 0) {
                    $mainOrder->update(['status' => 'delivered']);
                }
            }

            DB::commit();
            return back()->with('success', 'Manifest Updated Successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Update Failed: ' . $e->getMessage());
        }
    }
}
