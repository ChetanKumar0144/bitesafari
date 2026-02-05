<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Services\VendorDashboardService;

class VendorDashboardController extends Controller
{
    // Inject the dashboard service
    public function __construct(
        protected VendorDashboardService $dashboardService
    ) {}

    // Vendor dashboard
    public function index(VendorDashboardService $dashboardService)
    {
        $stats = $dashboardService->stats();
        return view('vendor.dashboard', compact('stats'));
    }
}
