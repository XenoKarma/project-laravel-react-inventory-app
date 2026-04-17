<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        // cek apakah user punya role yang diizinkan
        if (!in_array($request->user()->role, $role)) {
            abort(403, 'Unauthorized | Andika tidak diizinkan mengakses halaman ini!');
        }
        return $next($request);
    }
}
