<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\MenuController;
use App\Http\Controllers\Customer\OrderPlaceController;

/*
|--------------------------------------------------------------------------
| Customer Auth (Public)
|--------------------------------------------------------------------------
*/
Route::get('api-tester',function(){
    return view('customer.api-tester');
});

Route::get('/test-customer', function () {
    dd(auth('customer')->user());
});

Route::prefix('customer')->group(function () {

    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])
        ->name('customer.login');

    Route::post('/login', [CustomerAuthController::class, 'sendOtp'])
        ->name('customer.login.sendOtp');

    Route::get('/verify-otp', [CustomerAuthController::class, 'showOtpForm'])
        ->name('customer.otp.form');

    Route::post('/verify-otp', [CustomerAuthController::class, 'verifyOtp'])
        ->name('customer.otp.verify');
});

/*
|--------------------------------------------------------------------------
| Customer Authenticated
|--------------------------------------------------------------------------
*/
Route::middleware('auth:customer')
    ->prefix('customer')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('customer.dashboard');

        Route::get('/cart', [CartController::class, 'index'])
            ->name('customer.cart.index');

        Route::get('/cart', [CartController::class, 'add'])
            ->name('customer.cart.add');

        Route::get('/orders', [OrderController::class, 'index'])
            ->name('customer.orders');

        Route::post('/cart/increase/{food}', [CartController::class, 'increase'])
            ->name('customer.cart.increase');

        Route::post('/cart/decrease/{food}', [CartController::class, 'decrease'])
            ->name('customer.cart.decrease');

        // Route::post('/cart/add/{food}', [CartController::class, 'add'])
        //     ->name('customer.cart.add');

        Route::post('/cart/remove/{food}', [CartController::class, 'remove'])
            ->name('customer.cart.remove');

        Route::post('/place-order', [OrderController::class, 'placeOrder'])
            ->name('customer.placeOrder');

        Route::get('/checkout', [OrderPlaceController::class, 'checkout'])
            ->name('customer.checkout');

        Route::get('/menu', [MenuController::class, 'index'])
            ->name('customer.menu');

        Route::get('/', [MenuController::class, 'index'])
            ->name('customer.profile');

        Route::get('/orders/{order}', [OrderController::class, 'show'])
            ->name('customer.orders.show');

        Route::post('/logout', [CustomerAuthController::class, 'logout'])
            ->name('customer.logout');
    });

/*
|--------------------------------------------------------------------------
| Fallback (MUST BE LAST)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    $path = request()->path();

    if (str_starts_with($path, 'customer')) {
        return redirect()->route('customer.login');
    }

    abort(404);
});
