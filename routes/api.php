<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\FoodApiController;
use App\Http\Controllers\Api\V1\CategoryApiController;
use App\Http\Controllers\Api\V1\CustomerAddressApiController;
use App\Http\Controllers\Api\V1\CustomerAuthApiController;
use App\Http\Controllers\Api\V1\CustomerProfileApiController;
use App\Http\Controllers\Api\V1\CustomerOrderApiController;
use App\Http\Controllers\Api\V1\CustomerCartApiController;

Route::prefix('v1')->group(function () {

    // ----------------------------
    // Public APIs
    // ----------------------------
    Route::prefix('customer')->group(function () {
        Route::post('/send-otp', [CustomerAuthApiController::class, 'sendOtp'])->name('api.customer.sendOtp');
        Route::post('/verify-otp', [CustomerAuthApiController::class, 'verifyOtp'])->name('api.customer.verifyOtp');
    });

    Route::get('/foods', [FoodApiController::class, 'index'])->name('api.foods.index');
    Route::get('/categories', [CategoryApiController::class, 'index'])->name('api.categories.index');

    // ----------------------------
    // Authenticated APIs
    // ----------------------------
    Route::middleware('auth:sanctum')->group(function () {

        // Customer Auth
        Route::prefix('customer')->group(function () {
            Route::post('/logout', [CustomerAuthApiController::class, 'logout'])->name('api.customer.logout');
            Route::get('/me', [CustomerAuthApiController::class, 'me'])->name('api.customer.me');

            // Addresses
            Route::get('/addresses', [CustomerAddressApiController::class, 'index'])->name('api.customer.addresses.index');
            Route::post('/addresses', [CustomerAddressApiController::class, 'store'])->name('api.customer.addresses.store');
            Route::post('/addresses/{id}', [CustomerAddressApiController::class, 'update'])->name('api.customer.addresses.update');
            Route::delete('/addresses/{id}', [CustomerAddressApiController::class, 'destroy'])->name('api.customer.addresses.destroy');
            Route::get('/profile', [CustomerProfileApiController::class, 'me'])->name('api.customer.profile.get');
            Route::post('/profile', [CustomerProfileApiController::class, 'update'])->name('api.customer.profile.update');
            Route::get('/orders', [CustomerOrderApiController::class, 'index'])->name('api.customer.orders.index');
            Route::post('/orders', [CustomerOrderApiController::class, 'store'])->name('api.customer.orders.store');

            // Cart Operations
            Route::prefix('cart')->group(function () {
                Route::get('/', [CustomerCartApiController::class, 'index'])->name('api.cart.index');
                Route::post('/add', [CustomerCartApiController::class, 'store'])->name('api.cart.add'); // Items add karne ke liye
                Route::post('/decrement/{id}', [CustomerCartApiController::class, 'decrement'])->name('api.cart.decrement');
                Route::post('/update/{id}', [CustomerCartApiController::class, 'update'])->name('api.cart.update'); // Quantity badhane ke liye
                Route::delete('/remove/{id}', [CustomerCartApiController::class, 'destroy'])->name('api.cart.destroy'); // Item hatane ke liye
                Route::delete('/clear', [CustomerCartApiController::class, 'clear'])->name('api.cart.clear'); // Poora cart khali karne ke liye
            });
        });

        // Future: Orders, Cart, Payments etc. can go here
    });

});
