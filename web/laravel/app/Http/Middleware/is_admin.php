<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class is_admin
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
        if(Session::get('is_loginAdmin'))
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('dashboard.masuk');
        }
    }
}
