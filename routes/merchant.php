<?php


use Illuminate\Support\Facades\Route;
Route::middleware('user-type:merchant')->group(function () {
    Route::prefix('auth')->controller(\App\Http\Controllers\api\Merchant\AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
    });
});
