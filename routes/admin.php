<?php

use App\Http\Controllers\api\admin\ProductController;
use App\Http\Controllers\api\admin\CategoryController;
use App\Http\Controllers\api\admin\CustomerController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {

Route::prefix('auth')->controller(\App\Http\Controllers\api\admin\AuthController::class)->group(function () {
        Route::post('/login', 'login');
    });


    Route::middleware(['auth:sanctum','user-type:admin'])->group(function (){
        Route::apiResource('category',CategoryController::class);
        Route::apiResource('product',ProductController::class);
        Route::apiResource('customer',CustomerController::class);
        Route::post('/add-contact/{Customer}',[CustomerController::class,'addContact'] );
    });

    
});

