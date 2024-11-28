<?php

namespace App\Http\Middleware;

use Closure,Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() &&  Auth::user()->is_admin == 1) {
            // dd(Auth::user()->select('id', 'name','email')->first());
            return $next($request);
       }

       return redirect('login')->with('error','You have not admin access');
        // return $next($request);
    }
}
