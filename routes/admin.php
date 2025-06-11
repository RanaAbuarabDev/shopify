<?php

use App\Http\Controllers\api\admin\ProductController;
use App\Http\Controllers\api\admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('user-type:admin')->group(function () {
    Route::prefix('category')->controller(CategoryController::class)->group(function () {
        Route::post('/add', 'store');
        Route::get('/', 'index');
        Route::get('/{Category}', 'show');
        Route::put('/update/{Category}', 'update');
        Route::delete('/delete/{Category}', 'destroy');
    });
    Route::prefix('auth')->controller(\App\Http\Controllers\api\admin\AuthController::class)->group(function () {
        Route::post('/login', 'login');
    });
    Route::prefix('product')->controller(ProductController::class)->group(function () {
        Route::post('/add', 'store');
        Route::get('/', 'index');
        Route::get('/{Product}', 'show');
        Route::put('/update/{Product}', 'update');
        Route::delete('/delete/{Product}', 'destroy');
    });


    Route::prefix('customer')->controller(CustomerController::class)->group(function () {
        // Route::post('/add', 'store');
        // Route::get('/', 'index');
        // Route::get('/{Customer}', 'show');
        // Route::put('/update/{Customer}', 'update');
        // Route::delete('/delete/{Customer}', 'destroy');
        Route::post('/add-contact/{Customer}', 'addContact');
        // Route::put('/update-contact/{Customer}', 'updateContact');
        // Route::delete('/delete-contact/{Customer}', 'deleteContact');
        // Route::get('/get-contact/{Customer}', 'getContact');
        // Route::get('/get-contacts/{Customer}', 'getContacts');
    });
});

