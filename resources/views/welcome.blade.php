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
            <img src="{{ asset('assets/removebg-blanc.png') }}" alt="logo" class="logo">
            <a href="{{ route('accueil') }}">Accueil</a>
            <a href="{{ route('about') }}">À propos</a>
            <a href="{{ route('contact') }}">Contact</a>
            <button class="connexion"><a href="{{ route('connexion') }}">Connexion</a></button>
        </nav>

        <section class="hero">

            <h1>Bienvenue sur PréSchool</h1>
            <p>PréSchool est une plate-forme web conçu pour aider les élèves en difficulté.</p>

<button class="inscription">
    <a href="{{ route('eleve.register') }}" style="text-decoration: none;">Inscription</a>
</button>        </section>

        <h1>Annonces</h1>

        <div class="annonces">
            <div class="evenements">
                <h2>Evénements</h2>
                <div class="events">
                    <img src="{{ asset('assets/Gemini_Generated.png') }}" alt="Evénements">
                    <img src="{{ asset('assets/image_3D.png') }}" alt="Evénements">
                    <h3>Mise a jour des informations d'evenements</h3>
                    <p>Les élèves seront au courant des événements scolaires ainsi que les dates et programmes</p>
                </div>
            </div>
            <!-- les examens --> 
             <div class="examens">
                <h2>Examens</h2>
                <div class="examens1">
                    <img src="{{ asset('assets/sout4.jpg') }}" alt="Examens">
                    <img src="{{ asset('assets/sout3.jpg') }}" alt="Examens">
                    <h3>Mise a jour des informations d'examens</h3>
                    <p>Les dates des examens et concours de l'année scolaire</p>
                </div>
            </div>

            <!-- les bulletins -->
              <div class="bulletins">
                <h2>Bulletins</h2>
                <div class="bulletins1">
                    <img src="{{ asset('assets/images1.jpg') }}" alt="Bulletins">
                    <img src="{{ asset('assets/images.jpg') }}" alt="Bulletins">
                    <h3>Mise a jour des bulletins</h3>
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

<h1>Romans</h1>

<div class="carousel-container">
  <div class="carousel-track">
    <img src="{{ asset('assets/images3.jpeg') }}" alt="Image 1">
    <img src="{{ asset('assets/images2.jpeg') }}" alt="Image 2">
    <img src="{{ asset('assets/téléchargement4.jpeg') }}" alt="Image 3">
    <img src="{{ asset('assets/images5.jpeg') }}" alt="Image 4">
    <img src="{{ asset('assets/téléchargement1.jpeg') }}" alt="Image 5">
    <img src="{{ asset('assets/images6.jpeg') }}" alt="Image 6">
    <img src="{{ asset('assets/images1.jpeg') }}" alt="Image 7">
    <img src="{{ asset('assets/images.jpeg') }}" alt="Image 8">
    <img src="{{ asset('assets/téléchargement5.jpeg') }}" alt="Image 9">
    <img src="{{ asset('assets/téléchargement3.jpeg') }}" alt="Image 10">

    <!-- Duplication pour défilement infini -->
    <img src="{{ asset('assets/images3.jpeg') }}" alt="Image 1">
    <img src="{{ asset('assets/images2.jpeg') }}" alt="Image 2">
    <img src="{{ asset('assets/téléchargement4.jpeg') }}" alt="Image 3">
    <img src="{{ asset('assets/images5.jpeg') }}" alt="Image 4">
    <img src="{{ asset('assets/téléchargement1.jpeg') }}" alt="Image 5">
    <img src="{{ asset('assets/images6.jpeg') }}" alt="Image 6">
    <img src="{{ asset('assets/images1.jpeg') }}" alt="Image 7">
    <img src="{{ asset('assets/images.jpeg') }}" alt="Image 8">
    <img src="{{ asset('assets/téléchargement5.jpeg') }}" alt="Image 9">
    <img src="{{ asset('assets/téléchargement3.jpeg') }}" alt="Image 10">
  </div>
</div>



        <footer>
            <!-- liens en icônes -->
            <!-- <a href="{{ route('accueil') }}"><i class="fas fa-home"></i> Accueil</a>
            <a href="{{ route('about') }}"><i class="fas fa-info-circle"></i> À propos</a>
            <a href="{{ route('contact') }}"><i class="fas fa-envelope"></i> Contact</a></br> -->
            <p>&copy; 2026 PréSchool. Tous droits réservés.</p>
        </footer>
    </body>
