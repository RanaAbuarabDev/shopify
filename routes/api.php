<?php

use App\Http\Controllers\api\Customer\StripeController;
use App\Http\Controllers\api\FileController;
use Illuminate\Support\Facades\Route;
Route::prefix('admin')->group(function () {
    require __DIR__.'/admin.php';
});

Route::prefix('merchant')->group(function () {
    require __DIR__.'/merchant.php';
});

Route::prefix('customer')->group(function () {
    require __DIR__.'/customer.php';
});

Route::get('/test-api', function () {
    return response()->json(['message' => 'API Route Works!']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('upload-file', [FileController::class, 'uploadFile']);
    Route::post('download-file', [FileController::class, 'downloadFile']);
});


Route::post('stripe/success', [StripeController::class, 'success'])->name('stripe.success');

Route::get('stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');