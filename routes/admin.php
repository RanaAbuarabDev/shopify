<?php

use App\Http\Controllers\api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('user-type:admin')->prefix('category')->controller(CategoryController::class)->group(function () {
    Route::post('/add', 'store');
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::put('/update/{id}', 'update');
    Route::delete('/delete/{id}', 'destroy');
});


