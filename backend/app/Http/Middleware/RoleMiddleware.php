<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập trước.');
        }

        // Check if the user's role is in the allowed roles
        if (!in_array(Auth::user()->role, $roles)) {
            return abort(403, 'Unauthorized action.');
        }
        
        // dd('Current role: '.Auth::user()->role,'Allowed roles: (array below)',$roles);
        return $next($request);
    }
}
