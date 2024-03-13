<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppViewingApp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {       
        if(session()->has('auth_userid')){
            if(session()->get('auth_usertype') == 1){
                return $next($request);
            }
            else{
                if(count(array_intersect(['Module-08', 'Module-09', 'Module-010', 'Module-011'], session()->get('auth_usermodules'))) > 0){
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
