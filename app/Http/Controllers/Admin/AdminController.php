<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminDashboardService;

class AdminController extends Controller
{
     public function __construct(
        protected AdminDashboardService $dashboardService
    ) {}

    public function dashboard()
    {
        return view('admin.dashboard', $this->dashboardService->stats());
    }
}
