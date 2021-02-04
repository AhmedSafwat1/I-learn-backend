<?php

namespace App\Http\Middleware;

use Closure;

class LangApi
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
        if($request->header("lang"))
        {
            app()->setLocale($request->header("lang"));
        }
        if(auth("api")->check()){
            
        }   
       
        return $next($request);
      
    }
}
