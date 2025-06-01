<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->type === 'admin') {
            return $next($request);  // allow access
        }

        // If user is logged in but not admin, redirect to user dashboard or anywhere else
        if (Auth::check()) {
            return redirect('/');
        }

        // If not logged in, redirect to login page
        return redirect('/login');
    }
}
