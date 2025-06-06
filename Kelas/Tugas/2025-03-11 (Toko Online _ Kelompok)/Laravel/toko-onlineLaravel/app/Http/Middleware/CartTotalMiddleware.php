<?php
// app/Http/Middleware/CartTotalMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class CartTotalMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $cart = Session::get('cart', []);
        $cartTotalQuantity = array_sum($cart);

        // Share cart quantity with all views
        View::share('cartTotalQuantity', $cartTotalQuantity);

        return $next($request);
    }
}
