<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\VendorAuthController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Vendor\VendorOrderController;
use App\Http\Controllers\Vendor\VendorFoodController;
use App\Http\Controllers\Vendor\VendorProfileController;

// ===================== GUEST ROUTES (Vendor Login) =====================
Route::prefix('vendor')->name('vendor.')->group(function () {

    // Login form
    Route::get('/login', [VendorAuthController::class, 'showLoginForm'])->name('login');

    // Login submit
    Route::post('/login', [VendorAuthController::class, 'login'])->name('login.submit');
});

// ===================== AUTHENTICATED VENDOR ROUTES =====================
Route::prefix('vendor')
    ->name('vendor.')
    ->middleware('auth:vendor')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');

        // Orders
        Route::get('/orders', [VendorOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [VendorOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/status', [VendorOrderController::class, 'updateStatus'])->name('orders.update-status');

        // Profile
        Route::get('/profile', [VendorProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [VendorProfileController::class, 'update'])->name('profile.update');

        // Foods
        Route::get('/foods', [VendorFoodController::class, 'index'])->name('foods.index');
        Route::get('/foods/create', [VendorFoodController::class, 'create'])->name('foods.create');
        Route::post('/foods', [VendorFoodController::class, 'store'])->name('foods.store');
        Route::get('/foods/{food}/edit', [VendorFoodController::class, 'edit'])->name('foods.edit');
        Route::post('/foods/{food}', [VendorFoodController::class, 'update'])->name('foods.update');
        Route::delete('/foods/{food}', [VendorFoodController::class, 'destroy'])->name('foods.destroy');

        // Logout
        Route::post('/logout', [VendorAuthController::class, 'logout'])->name('logout');
});
