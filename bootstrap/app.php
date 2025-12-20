<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Ajout des middlewares personnalisés
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
            'isProfesseur' => \App\Http\Middleware\IsProfesseur::class,
            'isEleve' => \App\Http\Middleware\IsEleve::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
