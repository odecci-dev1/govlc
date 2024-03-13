<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $module_code): Response
    {        

        if(session()->has('auth_userid')){
            if(session()->get('auth_usertype') == 1){
                return $next($request);
            }
            else{
                if(in_array($module_code, session()->get('auth_usermodules'))){
                    return $next($request);
                }  
                else{
                    return abort(404);
                }    
            }          
        }
        else{
            return redirect('/logout');
        }
    }
}
