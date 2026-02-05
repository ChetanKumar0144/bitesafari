<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Services\VendorDashboardService;
use Illuminate\Support\Facades\Auth;

class VendorDashboardController extends Controller
{
    // Constructor injection is enough
    public function __construct(
        protected VendorDashboardService $dashboardService
    ) {}

    /**
     * Display the Vendor Command Center
     */
    public function index()
    {
        // Service se stats fetch karein
        // Note: Service ke andar Auth::guard('vendor')->id() use karna best rahega
        $stats = $this->dashboardService->stats();

        return view('vendor.dashboard', [
            'stats' => $stats,
            'vendor' => Auth::guard('vendor')->user()
        ]);
    }
}
