<?php

namespace App\Http\Middleware;

use Closure;

class MaMiddleware
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
                   //checking usere role. admin==1/user==0
                   if(Auth::user()->role==1){
                    return $next($request);
                }
                else{
                    return redirect()->back()->with('message','Access Denied.You are not the Admin ');

                }



            return $next($request);
    }
}
