<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    if (!auth()->check()) {
        \Log::info('User not authenticated.');
        return redirect()->route('login');
    }

    \Log::info('User Role: ' . auth()->user()->role);

    if (auth()->user()->role === 'user') {
        return $next($request);
    }

    return redirect('/')->with('error', 'Unauthorized access for user');
}
}
