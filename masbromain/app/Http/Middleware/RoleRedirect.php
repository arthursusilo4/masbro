<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    public function handle(Request $request, Closure $next, $role = null): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $roleId = Auth::user()->role_id;

        if (is_null($role)) {
            switch ($roleId) {
                case 1: return redirect()->route('user.home');
                case 2: return redirect()->route('branch.home');
                case 3: return redirect()->route('regional.home');
                default: return redirect('/login');
            }
        }

        if ($roleId != $role) {
            return redirect('/login');
        }

        return $next($request);
    }
}
