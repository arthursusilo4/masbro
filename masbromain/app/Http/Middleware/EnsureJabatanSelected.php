<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\SessionJabatan;

class EnsureJabatanSelected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $user = Auth::user();

        if ($user && $user->role_id == 1) {
            $sessionId = session()->getId();

            $hasJabatan = SessionJabatan::where('user_id', $user->id)
                ->where('session_id', $sessionId)
                ->exists();

            if (!$hasJabatan) {
                return redirect()->route('post-login.show');
            }
        }

        return $next($request);
    }
}
