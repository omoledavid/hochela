<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBloggersStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('bloggers')->check()){
            $bloggers = auth()->guard('bloggers')->user();
            if ($bloggers->status  && $bloggers->ev  && $bloggers->sv  && $bloggers->tv) {
                return $next($request);
            } else {
                return redirect()->route('bloggers.authorization');
            }
        }
        abort(403);
    }
}
