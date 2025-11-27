<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
<<<<<<< HEAD
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',

        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "user-type"=>\App\Http\Middleware\CheckRoleMiddleware::class]);
=======
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
>>>>>>> 5270ef75c682166a1e9125b37f7f4c1d16bafa49
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
