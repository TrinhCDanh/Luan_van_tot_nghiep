<?php

namespace App\Http\Middleware\Giangvien;

use Closure;

class RedirectIfAuthenticated  
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'giangvien')
    {
        if (\Auth::guard($guard)->check()) {
            return redirect('/giangvien/dashboard/');
        }

        return $next($request);
    }
}