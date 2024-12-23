<?php
namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRedirectIfAuthenticated{
    /**
     * Handle an incoming request
     * 
     * @param \closure(\illuminate\Http\Request):
     (Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, String ...$guards):Response{

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($guard.'/dashboard');
            }
        }
        return $next($request);
    }
}