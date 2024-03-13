<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {       
        if(session()->has('auth_userid')){
            return $next($request);
        }
        else{          
            $request->session()->flush();
            return redirect('/')->with('message', 'You don\'t have current active session');       
        }
    }
}
