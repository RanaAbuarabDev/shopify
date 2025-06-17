<?php

use App\Http\Controllers\api\FileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/admin.php';
require __DIR__.'/merchant.php';
require __DIR__.'/customer.php';


Route::middleware('auth:sanctum')->group(function () {
    Route::post('upload-file', [FileController::class, 'uploadFile']);
    Route::post('download-file', [FileController::class, 'downloadFile']);
});