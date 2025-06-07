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
        $brokenDownRoles = $this->breakDownIntoChars(...$roles);
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập trước.');
        }

        // Check if the user's role is in the allowed roles
        if (!in_array(Auth::user()->role, $brokenDownRoles)) {
            return redirect()->route('client.home')->with('error', 'Vui lòng đăng nhập trước.');
            // return abort(403, 'Bạn không có quyền truy cập.');
        }

        // dd('Current role: '.Auth::user()->role,'Allowed roles: (array below)',$roles);
        return $next($request);
    }

    // input: ["012"] => output: ['0','1','2']
    private function breakDownIntoChars(...$arg) {
        $result = [];
        foreach ($arg as $value) {
            $itemAsString = (string) $value;
            if ($itemAsString === '') {
                continue;
            }
            $chars = str_split($itemAsString);

            foreach($chars as $char) {
                $result[] = $char;
            }
        }
        return $result;
    }
}
