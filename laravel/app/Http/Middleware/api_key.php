<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class api_key
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
        $response = $next($request);

        if($request->header('apikey') === '3NbeKqHdqRCsxL+i+HlsKA==:YWJkdWxyb2htYW4wMDAwMA==')
        {
            return $response;
        }
        else
        {
            return response()->json(['status' => false, 'code' => 401, 'message' => 'Api Key unauthorized'], 401);
        }
    }
}
