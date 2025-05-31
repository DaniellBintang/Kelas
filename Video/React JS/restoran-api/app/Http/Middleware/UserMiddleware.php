<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Cek jika ada role di query string, set ke session (untuk testing)
        if ($request->user <> 'admin') {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
