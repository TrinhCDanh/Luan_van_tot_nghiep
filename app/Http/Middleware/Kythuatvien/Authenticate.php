<?php

namespace App\Http\Middleware\Kythuatvien;

use Closure;

class Authenticate  
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
        if (\Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('kythuatvien/login');
            }
        }

        return $next($request);
    }
}