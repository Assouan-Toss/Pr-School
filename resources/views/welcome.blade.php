<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>
        <div></div>
        <nav>
            <a href="{{ route('accueil') }}">Accueil</a>
            <a href="{{ route('about') }}">À propos</a>
            <a href="{{ route('contact') }}">Contact</a>
            <button><a href="{{ route('connexion') }}">Connexion</a></button>
        </nav>

        <section>
            <h1>Bienvenue sur PréSchool</h1>
            <p>PréSchool est une plate-forme web conçu pour aider les élèves en difficulté.</p>

            <button><a href="{{ route('inscription') }}">Inscription</a></button>
        </section>
    </body>
