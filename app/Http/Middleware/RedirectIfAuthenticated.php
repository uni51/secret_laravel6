<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

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
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // 認証区分がある（'admin'）の時は、route('admin.top'）にリダイレクトさせ、そうでない時は、'/'にリダイレクトさせる
            $url = ($guard) ? route($guard.'.top'): '/';
            return redirect($url);
        }

        return $next($request);
    }
}
