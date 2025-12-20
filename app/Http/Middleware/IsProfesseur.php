<?php

namespace App\Http\Middleware;

use Closure;

class IsProfesseur
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'professeur') {
            abort(403, 'Accès interdit');
        }
        return $next($request);
    }
}
