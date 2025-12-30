<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    </head>

    <style>
    </style>

    <body>
        <div class="barbleur"></div>
        <nav class="navbar">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            <a href="{{ route('accueil') }}">Accueil</a>
            <a href="{{ route('about') }}">À propos</a>
            <a href="{{ route('contact') }}">Contact</a>
            <button class="connexion"><a href="{{ route('connexion') }}">Connexion</a></button>
        </nav>

        <section class="hero">
            <h1>Bienvenue sur PréSchool</h1>
            <p>PréSchool est une plate-forme web conçu pour aider les élèves en difficulté.</p>

            <button class="inscription"><a href="{{ route('inscription') }}">Inscription</a></button>
        </section>

        <h1>Annonces</h1>

        <div class="annonces">
            <div class="evenements">
                <h2>Evénements</h2>
                <div class="events">
                    <img src="{{ asset('images/events.jpg') }}" alt="Evénements">
                    <img src="{{ asset('images/events.jpg') }}" alt="Evénements">
                    <h2>Mise a jour des informations d'evenements</h2>
                    <p>Les élèves seront au courant des événements scolaires ainsi que les dates et programmes</p>
                </div>
            </div>
            <!-- les examens --> 
             <div class="examens">
                <h2>Examens</h2>
                <div class="examens1">
                    <img src="{{ asset('images/exam.jpg') }}" alt="Examens">
                    <img src="{{ asset('images/exam.jpg') }}" alt="Examens">
                    <h2>Mise a jour des informations d'examens</h2>
                    <p>Les dates des examens et concours de l'année scolaire</p>
                </div>
            </div>

            <!-- les bulletins -->
              <div class="bulletins">
                <h2>Bulletins</h2>
                <div class="bulletins1">
                    <img src="{{ asset('images/bulletin.jpg') }}" alt="Bulletins">
                    <img src="{{ asset('images/bulletin.jpg') }}" alt="Bulletins">
                    <h2>Mise a jour des bulletins</h2>
                    <p>Les notes et evaluations des eleves</p>
                </div>
            </div>
        </div>

        <!-- <h1>Actualités</h1>
        <div></div>
                <div>
                    <img src="{{ asset('images/news.jpg') }}" alt="Actualités">
                    <img src="{{ asset('images/news.jpg') }}" alt="Actualités">
                    <h2>Mise a jour des actualites</h2>
                    <p>Les dernières actualites de PréSchool</p>
                </div>
        </div> -->

        <footer>
            <p>&copy; 2023 PréSchool. Tous droits réservés.</p>
        </footer>
    </body>
