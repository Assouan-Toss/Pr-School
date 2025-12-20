<?php

namespace App\Http\Middleware;

use Closure;

class IsEleve
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'eleve') {
            abort(403, 'Accès interdit');
        }
        return $next($request);
    }
}
