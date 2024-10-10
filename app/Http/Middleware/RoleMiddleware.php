<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request);
        }

        return redirect('/home')->with('status', 'Access Denied! You do not have permission to access this page.');
    }
}
