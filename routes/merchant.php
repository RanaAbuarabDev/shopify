<?php

use App\Http\Controllers\api\Merchant\OrderItemController;
use App\Http\Controllers\api\Merchant\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->controller(\App\Http\Controllers\api\Merchant\AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

Route::middleware(['auth:sanctum', 'user-type:merchant'])->group(function () {

    Route::apiResource('products', ProductController::class);
    Route::get('order_items', [OrderItemController::class, 'index']);
    Route::get('order_items/{orderItem}', [OrderItemController::class, 'show']);
    Route::put('order_items/{orderItem}', [OrderItemController::class, 'update']);

});
