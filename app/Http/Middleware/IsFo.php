<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsFo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $isfo): Response
    {
        if(session()->has('auth_remittance_only')){
            if(session()->get('auth_remittance_only') == $isfo){
                return $next($request);
            }
            else{
                return abort(404);
            }          
        }
        else{
            return redirect('/logout');
        }
    }
}
