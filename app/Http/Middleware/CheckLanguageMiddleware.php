<?php

namespace App\Http\Middleware;

use Closure;

class CheckLanguageMiddleware
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
        $language = $request->input('language');

        if (in_array($language, ['en', 'es', 'fr'])) {
            return $next($request);
        }

        return response('Language parameter is missing or invalid.', 400);
    }
}
