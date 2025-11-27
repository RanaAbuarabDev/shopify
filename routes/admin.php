<?php

use App\Http\Controllers\api\admin\ProductController;
use App\Http\Controllers\api\admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\admin\CustomerController;
use App\Models\Category;

Route::prefix('auth')->controller(\App\Http\Controllers\api\admin\AuthController::class)->group(function () {

    Route::post('/login', 'login');
});
//Route::middleware('user-type:admin')->group(function () {
Route::middleware(['auth:sanctum', 'user-type:admin'])->group(function () {
        Route::get('category_tree', [CategoryController::class, 'index_tree']);
        Route::apiResource('category', CategoryController::class);
        Route::apiResource('product', ProductController::class);
        Route::apiResource('customer', CustomerController::class);
        Route::post('/add-contact/{Customer}', [CustomerController::class, 'addContact']);
});

Route::middleware(['auth::sanctum','user-type:admin'])->group(function(){
    Route::get('');
    Route::apiResource('category',CategoryController::class);
    
});