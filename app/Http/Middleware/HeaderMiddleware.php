<?php

namespace App\Http\Middleware;


class HeaderMiddleware extends Middleware
{
    public function handle($request, Closure $next)
    {
        $token='Bearer '.$request->bearerToken();
        $response=$next($request);
        $response->header('Authorization', $token);
    
        return $response;
    }
}
