<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuthToken
{
    public function handle(Request $request, Closure $next)
    {
        // ambil token dari sessionStorage/localStorage via cookie/session
        $token = session('access_token'); // kalau kamu simpan di session Laravel

        if (!$token) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
