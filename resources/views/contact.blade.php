<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact - PréSchool</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <style>
            .contact-form {
                max-width: 600px;
                margin: 40px auto;
                padding: 20px;
                background: #f9f9f9;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            .form-group {
                margin-bottom: 20px;
                text-align: left;
            }
            .form-group label {
                display: block;
                margin-bottom: 8px;
                font-weight: bold;
                color: #333;
            }
            .form-group input, .form-group textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 1rem;
            }
            .btn-submit {
                background-color: #3D80DB;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 1rem;
            }
            .btn-submit:hover {
                background-color: #1B13AD;
            }
            .contact-info {
                text-align: center;
                margin: 40px 0;
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
            <h1>Contactez-nous</h1>
            <p>Une question ? Un problème ? Nous sommes là pour vous aider.</p>
        </section>

        <div class="contact-info">
            <p>Email: <strong>contact@preschool.com</strong></p>
            <p>Téléphone: <strong>+33 1 23 45 67 89</strong></p>
        </div>

        <div class="contact-form">
            <form>
                <div class="form-group">
                    <label>Nom complet</label>
                    <input type="text" placeholder="Votre nom" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="Votre email" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea rows="5" placeholder="Votre message" required></textarea>
                </div>
                <button type="submit" class="btn-submit">Envoyer le message</button>
            </form>
        </div>

        <footer>
            <p>&copy; 2023 PréSchool. Tous droits réservés.</p>
        </footer>
    </body>
</html>
