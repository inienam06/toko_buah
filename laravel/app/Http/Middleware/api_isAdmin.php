<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Admin;

class api_isAdmin
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
        if(!empty($request->header('Authorization')))
        {
            $auth = str_replace('Bearer ', '', $request->header('Authorization'));

            if(Admin::where('api_token', $auth)->count() < 1)
            {
                return response()->json(['status' => true, 'code' => 404, 'message' => 'User unauthorized'], 404);
            }
            else
            {
                return $next($request);
            }
        }
        else
        {
            return response()->json(['status' => false, 'code' => 401, 'message' => 'Header Authorization not found'], 401);
        }
    }
}
