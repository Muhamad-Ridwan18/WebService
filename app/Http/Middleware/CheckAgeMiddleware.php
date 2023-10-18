<?php

namespace App\Http\Middleware;

use Closure;

class CheckAgeMiddleware
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
        $age = $request->input('age');

        if (is_numeric($age) && $age >= 18) {
            return $next($request);
        }

        return response('Age parameter is missing, not numeric, or under 18.', 400);
    }
}
