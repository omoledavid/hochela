<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfBloggers
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'bloggers')
    {
        if (Auth::guard($guard)->check()) {
            return redirect()->route('bloggers.dashboard');
        }
        return $next($request);
    }
}
