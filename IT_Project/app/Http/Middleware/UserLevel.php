<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserLevel
{
    public function handle($request, Closure $next, $level)
    {
        if (Auth::check() && Auth::user()->level === $level) {
            return $next($request);
        }
        
        return redirect('/login')->withErrors(['access' => 'Akses tidak diizinkan.']);
    }
}
