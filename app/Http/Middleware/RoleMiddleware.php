<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{

    public function handle(Request $request, Closure $next, $role, $role2 = null)
    {
        if (!Auth::check())
            return redirect('/');
        $user = Auth::user();
        if (($user->role_id == $role) || ($user->role_id == $role2))
            return $next($request);
        return redirect()->back();
    }
}
