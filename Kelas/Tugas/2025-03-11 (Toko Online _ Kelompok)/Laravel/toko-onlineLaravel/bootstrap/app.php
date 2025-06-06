<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register middleware aliases
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuthenticate::class,
            'customer.auth' => \App\Http\Middleware\CustomerAuthenticate::class, // Add this line
        ]);

        // Add middleware to the web group
        $middleware->web(append: [
            \App\Http\Middleware\CartTotalMiddleware::class,
        ]);

        // Alternative: if you want to prepend instead of append
        // $middleware->web(prepend: [
        //     \App\Http\Middleware\CartTotalMiddleware::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
