<?php

namespace App\Http\Middleware;

use Closure;

class CORS
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
        // for request
        // header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Headers: Content-type, X-Auth-Token,Authorization,Origin ');
        // header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        return $next($request)
            //for response
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, HEAD, PUT, PATCH, POST,DELETE')
            ->header('Access-Control-Allow-Headers', 'Content-type, X-Auth-Token,Authorization,Origin ');

    }
}

