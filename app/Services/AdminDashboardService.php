<?php

namespace App\Services;

class AdminDashboardService
{
    public function __construct(
        protected FoodService $foodStats,
        protected OrderService $orderStats,
        protected UserService $userStats,
        protected CustomerService $customerStats,
        protected VendorService $vendorStats,
    ) {}

    public function stats(): array
    {
        return [
            'totalFoods'        => $this->foodStats->total(),
            // 'topFood'           => $this->foodStats->topSelling(),
            'totalOrders'       => $this->orderStats->total(),
            'pendingOrders'     => $this->orderStats->pending(),
            'todayOrders'       => $this->orderStats->todayOrders(),
            'todayCompletedOrders'=> $this->orderStats->todayCompleted(),
            'todayPendingOrders'=> $this->orderStats->todayPending(),
            'todayRevenue'      => $this->orderStats->todayRevenue(),
            'orderTrends'       => $this->orderStats->orderTrend(),
            'totalUsers'        => $this->userStats->totalUsers(),
            'totalCustomers'    => $this->customerStats->totalCustomers(),
            'totalVendors'      => $this->vendorStats->totalVendors(),
            'newCustomers'      => $this->customerStats->newToday(),
            // 'monthlyRevenue'    => $this->orderStats->monthlyRevenue(), // Optional, add method
            // 'pendingDeliveries' => $this->orderStats->pendingDeliveries(), // Optional
        ];
    }

}
