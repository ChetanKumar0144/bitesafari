<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminVendorController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // 1. Check if Admin/User is logged in
    if (Auth::guard('web')->check()) {
        return redirect()->route('admin.dashboard');
    }

    // 2. Check if Vendor is logged in
    if (Auth::guard('vendor')->check()) {
        return redirect()->route('vendor.dashboard');
    }

    // 3. Check if Customer is logged in
    if (Auth::guard('customer')->check()) {
        return redirect()->route('customer.dashboard');
    }

    return view('welcome');
})->name('welcome');

// Error Testing Route (Keep it clean)
Route::get('/test-error/{code}', function ($code) {
    abort($code);
})->middleware('auth'); // Only admin/user can test

/*
|--------------------------------------------------------------------------
| Dashboard Redirect (Smart Routing)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:web,vendor,customer')->get('/dashboard', function () {

    // 1. Check for Admin/Default User [web guard]
    if (Auth::guard('web')->check()) {
        return Auth::user()->role == 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }

    // 2. Check for Vendor [vendor guard]
    if (Auth::guard('vendor')->check()) {
        return redirect()->route('vendor.dashboard');
    }

    // 3. Check for Customer [customer guard]
    if (Auth::guard('customer')->check()) {
        return redirect()->route('customer.dashboard');
    }

    // Fallback if something goes wrong
    return redirect('/');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes (Role: Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        // Main Stats
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // 🍔 Food Management
        Route::controller(FoodController::class)->prefix('foods')->group(function () {
            Route::get('/', 'index')->name('food.index');
            Route::get('/create', 'create')->name('food.create');
            Route::post('/store', 'store')->name('food.store');
            Route::get('/{food}/edit', 'edit')->name('food.edit');
            Route::post('/{food}/update', 'update')->name('food.update');
            Route::delete('/{food}/delete', 'destroy')->name('food.destroy');
        });

        // 📁 Category Management
        Route::controller(CategoryController::class)->prefix('categories')->group(function () {
            Route::get('/', 'index')->name('admin.categories.index');
            Route::get('/create', 'create')->name('admin.categories.create');
            Route::post('/store', 'store')->name('admin.categories.store');
            Route::get('/edit/{id}', 'edit')->name('admin.categories.edit');
            Route::post('/update/{id}', 'update')->name('admin.categories.update');
            Route::get('/delete/{id}', 'destroy')->name('admin.categories.delete');
        });

        // 📦 Orders Management
        Route::controller(OrderController::class)->prefix('orders')->group(function () {
            Route::get('/', 'index')->name('admin.orders.index');
            Route::get('/pending', 'pending')->name('orders.pending');
            Route::get('/completed', 'completed')->name('orders.completed');
            Route::get('/delivered', 'delivered')->name('orders.delivered');
            Route::get('/{order}', 'show')->name('orders.show');
            Route::post('/{order}/status', 'updateStatus')->name('admin.orders.update-status');
        });

        // 👥 Customer Management
        Route::controller(AdminUserController::class)->prefix('users')->group(function () {
            Route::get('/', 'index')->name('users.index');
            Route::get('/{customer}', 'show')->name('users.show');
            Route::patch('/{customer}/status', 'toggleStatus')->name('users.status');
            Route::get('/export', 'export')->name('users.export');
        });

        // 🏪 Vendor Management
        Route::controller(AdminVendorController::class)->prefix('vendors')->group(function () {
            Route::get('/', 'index')->name('admin.vendors.index');
            Route::get('/create', 'create')->name('admin.vendors.create');
            Route::post('/store', 'store')->name('admin.vendors.store');
            Route::get('/{vendor}/edit', 'edit')->name('admin.vendors.edit');
            Route::put('/{vendor}/update', 'update')->name('admin.vendors.update');
            Route::delete('/{vendor}/delete', 'destroy')->name('admin.vendors.destroy');
        });

        // ⚙️ Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    });

/*
|--------------------------------------------------------------------------
| User Routes (Role: User)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    });

/*
|--------------------------------------------------------------------------
| Auth & Secondary Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
require __DIR__.'/customer.php';
require __DIR__.'/vendor.php';
