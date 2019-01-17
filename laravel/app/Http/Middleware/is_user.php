<?php

namespace App\Http\Middleware;

use Closure;

class is_user
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
        if(session()->get('is_loginUser'))
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('template');
        }
    }
}
