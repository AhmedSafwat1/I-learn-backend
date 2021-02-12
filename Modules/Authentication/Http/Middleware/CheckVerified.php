<?php

namespace Modules\Authentication\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVerified
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
        // dd(auth()->id());
        
        if(auth()->check() && auth()->user()->is_verified){
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => __("authentication::api.verified.not_verifed"),
        ], 423);
    }
}
