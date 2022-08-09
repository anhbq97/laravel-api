<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @method static User hasRole() *
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!Auth::user()->hasRole($permission)) {
            abort(403, 'Permission denied');
        }
        
        return $next($request);
    }
}
