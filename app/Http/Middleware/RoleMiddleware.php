<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika user tidak login atau perannya tidak ada di dalam daftar $roles yang diizinkan
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            // Alihkan ke halaman dashboard (atau halaman lain)
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}