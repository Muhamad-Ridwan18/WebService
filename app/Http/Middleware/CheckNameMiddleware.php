<?php

namespace App\Http\Middleware;

use Closure;

class CheckNameMiddleware
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
        if ($request->has('name') && !empty($request->input('name'))) {
            return $next($request);
        }

        return response('Name parameter is missing or empty.', 400);
    }
}
