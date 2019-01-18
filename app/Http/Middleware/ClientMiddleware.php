<?php

namespace App\Http\Middleware;

use Closure;

class ClientMiddleware
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
        $response = $next($request);

        if (\Auth::guest()) {
            return $response->cookie('client_token', \OpenID::getClientToken(), 30, NULL, NULL, FALSE, FALSE);
        }

        return $response;
    }
}
