<?php

namespace App\Http\Middleware;

use Closure;

class LecMiddleware
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
        if(Auth::user()->role==150){
            return $next($request);
        }
        else{
            return redirect()->back()->with('message','Access Denied.You are not a lecture ');

        }


        return $next($request);
    }
}
