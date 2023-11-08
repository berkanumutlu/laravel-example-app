<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $default_language = 'tr';
        $language = app()->getLocale();
        //dump(app()->getLocale());
        if ($language !== $default_language) {
            app()->setLocale($default_language);
        }
        //dump(app()->getLocale());
        return $next($request);
    }
}
