<?php

namespace App\Http\Middleware;

use Closure;

class IsProfesseur
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || !in_array(auth()->user()->role, ['professeur', 'admin'])) {
            abort(403, 'Accès interdit');
        }
        return $next($request);
    }
}
