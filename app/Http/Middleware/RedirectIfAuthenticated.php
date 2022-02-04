<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guards = null)
    {
      //  $guard = empty($guards) ? [null] : $guards;

        if ($guards == "admin" && Auth::guard($guards)->check()) {
                return redirect('/admin');
            }
           
            if (Auth::guard($guards)->check()) {
                return redirect('/home');
            }

        return $next($request);
    }
}
