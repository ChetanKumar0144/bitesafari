<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Vendor\VendorAuthApiController;
use App\Http\Controllers\Api\V1\Vendor\VendorApiController;
use App\Http\Controllers\Api\V1\Vendor\VendorFoodApiController;

Route::prefix('v1/vendor')->group(function () {
    Route::post('/login', [VendorAuthApiController::class, 'verifyUser']);
});

Route::middleware('auth:sanctum')->prefix('v1/vendor')->group(function () {
    Route::get('/profile', [VendorApiController::class, 'getProfile']);

    Route::get('/kitchen-menu',[VendorFoodApiController::class,'foods']);
    Route::post('/profile',[VendorApiController::class,'updateProfile']);
    Route::post('/logout', [VendorAuthApiController::class, 'logout']);
});
