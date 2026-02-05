<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\ProfileController;
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
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    return Auth::user()->role_id == 1
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Food Management (Admin Only)
        Route::get('/foods', [FoodController::class, 'index'])->name('food.index');
        Route::get('/foods/create', [FoodController::class, 'create'])->name('food.create');
        Route::post('/foods/store', [FoodController::class, 'store'])->name('food.store');
        Route::get('/foods/{food}/edit', [FoodController::class, 'edit'])->name('food.edit');
        Route::post('/foods/{food}/update', [FoodController::class, 'update'])->name('food.update');
        Route::delete('/foods/{food}/delete', [FoodController::class, 'destroy'])->name('food.destroy');

        Route::prefix('/categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
            Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
        });

        // Orders Management
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/pending', [OrderController::class, 'pending'])->name('orders.pending');
        Route::get('/orders/completed', [OrderController::class, 'completed'])->name('orders.completed');
        Route::get('/orders/delivered', [OrderController::class, 'delivered'])->name('orders.delivered');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');

        // Customers
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{customer}', [AdminUserController::class, 'show'])->name('users.show');
        Route::patch('/users/{customer}/status', [AdminUserController::class, 'toggleStatus'])->name('users.status');
        Route::get('/users-export', [AdminUserController::class, 'export'])->name('users.export');


        // Vendor Management
        Route::get('vendors', [AdminVendorController::class, 'index'])->name('admin.vendors.index');
        Route::get('vendors/create', [AdminVendorController::class, 'create'])->name('admin.vendors.create');
        Route::post('vendors/store', [AdminVendorController::class, 'store'])->name('admin.vendors.store');
        Route::get('vendors/{vendor}/edit', [AdminVendorController::class, 'edit'])->name('admin.vendors.edit');
        Route::put('vendors/{vendor}/update', [AdminVendorController::class, 'update'])->name('admin.vendors.update');
        Route::delete('vendors/{vendor}/delete', [AdminVendorController::class, 'destroy'])->name('admin.vendors.destroy');


        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

    });

/*
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->group(function () {

        Route::get('/dashboard', [UserController::class, 'dashboard'])
            ->name('user.dashboard');
    });

/*
|--------------------------------------------------------------------------
| Profile (Common)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Route::get('/profile', [ProfileController::class, 'edit'])
    //     ->name('profile.edit');

    // Route::patch('/profile', [ProfileController::class, 'update'])
    //     ->name('profile.update');

    // Route::delete('/profile', [ProfileController::class, 'destroy'])
    //     ->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/customer.php';
require __DIR__.'/vendor.php';

