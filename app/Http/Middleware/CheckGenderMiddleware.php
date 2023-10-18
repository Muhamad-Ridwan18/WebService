<?php

namespace App\Http\Middleware;

use Closure;

class CheckGenderMiddleware
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
        $gender = $request->input('gender');

        if (in_array($gender, ['male', 'female'])) {
            return $next($request);
        }

        return response('Gender parameter is missing or invalid.', 400);
    }
}
