<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        //Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect('/login');
        }
        //Cek apakah role dalam user di izinkan
        $userRole = auth()->user()->role;
        if (!in_array($userRole, $roles)) {
            abort(403, 'Akses di tolak.');
        }
        return $next($request);
    }
}
