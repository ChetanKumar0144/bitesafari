<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Total orders (global or vendor-specific)
     */
    public function total(?int $vendorId = null): int
    {
        if (!$vendorId) {
            return Order::count(); // Admin: all orders
        }

        // Vendor: count unique orders that include this vendor's items
        return OrderItem::where('vendor_id', $vendorId)
            ->distinct('order_id')
            ->count('order_id');
    }

    /**
     * Pending orders
     */
    public function pending(?int $vendorId = null): int
    {
        if (!$vendorId) {
            return Order::where('status', 'pending')->count(); // Admin
        }

        return OrderItem::where('vendor_id', $vendorId)
            ->whereHas('order', fn($q) => $q->where('status', 'pending'))
            ->distinct('order_id')
            ->count('order_id');
    }

    /**
     * Orders created today
     */
    public function todayOrders(?int $vendorId = null): int
    {
        if (!$vendorId) {
            return Order::whereDate('created_at', today())->count();
        }

        return OrderItem::where('vendor_id', $vendorId)
            ->whereHas('order', fn($q) => $q->whereDate('created_at', today()))
            ->distinct('order_id')
            ->count('order_id');
    }

    /**
     * Completed orders today
     */
    public function todayCompleted(?int $vendorId = null): int
    {
        if (!$vendorId) {
            return Order::whereDate('created_at', today())
                ->where('status', 'completed')
                ->count();
        }

        return OrderItem::where('vendor_id', $vendorId)
            ->whereHas('order', fn($q) => $q->whereDate('created_at', today())
                                             ->where('status', 'completed'))
            ->distinct('order_id')
            ->count('order_id');
    }

    /**
     * Pending orders today
     */
    public function todayPending(?int $vendorId = null): int
    {
        if (!$vendorId) {
            return Order::whereDate('created_at', today())
                ->where('status', 'pending')
                ->count();
        }

        return OrderItem::where('vendor_id', $vendorId)
            ->whereHas('order', fn($q) => $q->whereDate('created_at', today())
                                             ->where('status', 'pending'))
            ->distinct('order_id')
            ->count('order_id');
    }

    /**
     * Revenue today
     */
    public function todayRevenue(?int $vendorId = null): float
    {
        if (!$vendorId) {
            return (float) Order::whereDate('created_at', today())->sum('total_amount');
        }

        return (float) OrderItem::where('vendor_id', $vendorId)
            ->whereHas('order', fn($q) => $q->whereDate('created_at', today()))
            ->sum(DB::raw('price * quantity'));
    }

    /**
     * Order trend for last $days days
     */
    public function orderTrend(int $days = 7, ?int $vendorId = null): array
    {
        $trend = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();

            if (!$vendorId) {
                $count = Order::whereDate('created_at', $date)->count();
            } else {
                $count = OrderItem::where('vendor_id', $vendorId)
                    ->whereHas('order', fn($q) => $q->whereDate('created_at', $date))
                    ->distinct('order_id')
                    ->count('order_id');
            }

            $trend[] = $count;
        }

        return $trend;
    }
}
