<?php

namespace App\Http\Middleware\Kythuatvien;

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
    public function handle($request, Closure $next, $guard = 'kythuatvien')
    {
        if (\Auth::guard($guard)->check()) {
            return redirect('/kythuatvien/dashboard/');
        }

        return $next($request);
    }
}