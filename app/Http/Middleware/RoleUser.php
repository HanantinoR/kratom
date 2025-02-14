<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class RoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$route_role)
    {
        $role = Auth::user()->user_type;
        if(!in_array($role,$route_role)){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            abort(404);
        }
        return $next($request);
    }
}
