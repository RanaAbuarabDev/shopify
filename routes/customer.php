<?php
use App\Http\Controllers\api\Customer\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('user-type:customer')->group(function () {
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
    });
});
