<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLoginPeserta
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek session khusus peserta
        if (!session()->has('peserta_logged_in')) {
            return redirect()->route('login')
            ->with('error', 'Anda harus login terlebih dahulu.')
            //hapus cache pada browser
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0, max-age=0');
        }
        return $next($request);
    }
}
