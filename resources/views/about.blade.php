<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>À propos - PréSchool</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <style>
             /* Styles spécifiques simplifiés pour À propos */
            .content-section {
                padding: 40px;
                max-width: 800px;
                margin: 0 auto;
                text-align: center;
            }
            .content-section p {
                font-size: 1.1rem;
                line-height: 1.6;
                color: #555;
            }
        </style>
    </head>

    <body>
        <div class="barbleur"></div>
        <nav class="navbar">
            <img src="{{ asset('assets/removebg-blanc.png') }}" alt="logo" class="logo">
            <a href="{{ route('accueil') }}">Accueil</a>
            <a href="{{ route('about') }}">À propos</a>
            <a href="{{ route('contact') }}">Contact</a>
            <button class="connexion"><a href="{{ route('connexion') }}">Connexion</a></button>
        </nav>

        <section class="hero" style="height: 40vh; min-height: 300px;">
            <h1>À propos de PréSchool</h1>
            <p>Notre mission : accompagner chaque élève vers la réussite.</p>
        </section>

        <div class="content-section">
            <h2>Qui sommes-nous ?</h2>
            <p>
                PréSchool est une plateforme éducative innovante conçue pour réduire les inégalités scolaires. 
                Nous proposons des ressources pédagogiques adaptées, un suivi des résultats et des outils de communication 
                pour rapprocher élèves, professeurs et l'administration.
            </p>
            <br>
            <br>
            <h2>Notre Vision</h2>
            <p>
                Nous croyons que chaque enfant a le potentiel de réussir si on lui donne les bons outils. 
                Notre objectif est de fournir un environnement numérique intuitif et motivant.
            </p>
            <br>
            <h2 id="privacy-policy">Politique de Confidentialité</h2>
            <p>
                Chez PréSchool, la confidentialité de vos données est notre priorité. 
                Nous collectons uniquement les informations nécessaires au bon fonctionnement de la plateforme éducative. 
                Vos données ne sont jamais partagées avec des tiers sans votre consentement explicite. 
                En utilisant notre service, vous acceptez notre traitement des données conformément à la législation en vigueur.
            </p>
        </div>

        <footer>
            <p>&copy; 2026 PréSchool. Tous droits réservés.</p>
        </footer>
    </body>
</html>
