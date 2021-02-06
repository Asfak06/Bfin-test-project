<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class Unblocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->blocked){
            return response()->view('warnings.blocked');
        }else{
            return $next($request);
        }
    }
}
