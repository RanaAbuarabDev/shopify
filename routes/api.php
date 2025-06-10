<?php

use Illuminate\Support\Facades\Route;
Route::prefix('admin')->group(function () {
    require __DIR__.'/admin.php';
});

Route::prefix('marchant')->group(function () {
    require __DIR__.'/marchant.php';
});

Route::prefix('customer')->group(function () {
    require __DIR__.'/customer.php';
});

Route::get('/test-api', function () {
    return response()->json(['message' => 'API Route Works!']);
});

