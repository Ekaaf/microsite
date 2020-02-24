<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Bdo
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
        if (Auth::check()){
            if (Auth::user()->type==4){
                
            }
            else{
                return abort(401, 'You are not authorized.');
            }
            
        }
        else{
            return redirect()->intended('login');
        }

        return $next($request);

    }
}
