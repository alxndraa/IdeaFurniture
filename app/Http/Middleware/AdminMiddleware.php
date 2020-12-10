<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Auth::user() -> if user exist which mean that the user has logged in
        //If user has logged in and their role is admin
        if(Auth::user() && auth()->user()->role !== 'admin'){
            abort(403, "Only for admins");
        }
        return $next($request);
    }
}
