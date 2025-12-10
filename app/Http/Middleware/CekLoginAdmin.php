<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek session khusus admin
        if (!session()->has('admin_logged_in')) {
            return redirect('/admin/login')->with('error', 'Silakan login sebagai Admin.');
        }
        return $next($request);
    }
}
