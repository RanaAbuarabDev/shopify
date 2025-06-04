<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/admin.php';

Route::get('/test-api', function () {
    return response()->json(['message' => 'API Route Works!']);
});

