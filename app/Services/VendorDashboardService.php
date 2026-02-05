<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class VendorDashboardService
{
    public function __construct(
        protected FoodService $foodStats,
        protected OrderService $orderStats,
        protected CustomerService $customerStats,
    ) {}

    public function stats(): array
    {
        $vendorId = Auth::id(); // get logged-in vendor ID

        return [
            'totalFoods'           => $this->foodStats->total($vendorId),
            // 'topFood'            => $this->foodStats->topSelling($vendorId), // optional
            'totalOrders'          => $this->orderStats->total($vendorId),
            'pendingOrders'        => $this->orderStats->pending($vendorId),
            'todayOrders'          => $this->orderStats->todayOrders($vendorId),
            'todayCompletedOrders' => $this->orderStats->todayCompleted($vendorId),
            'todayPendingOrders'   => $this->orderStats->todayPending($vendorId),
            'todayRevenue'         => $this->orderStats->todayRevenue($vendorId),
            'orderTrends'          => $this->orderStats->orderTrend($vendorId),
            'totalCustomers'       => $this->customerStats->totalCustomers($vendorId),
            'newCustomers'         => $this->customerStats->newToday($vendorId),
        ];
    }
}
