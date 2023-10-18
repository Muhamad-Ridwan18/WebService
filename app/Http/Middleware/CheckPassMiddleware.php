<?php

namespace App\Http\Middleware;

use Closure;

class CheckPassMiddleware
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
        if ($request->has('pass') && !empty($request->input('pass'))) {
            return $next($request);
        }

        return response('Pass parameter is missing or empty.', 400);

    }
}
