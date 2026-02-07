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
            <p>Notre mission : faciliter la réussite de chaque élève.</p>
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
                En utilisant notre service, vous acceptez notre traitement des données conformément à la législation en vigueur.<br>

                1. Collecte des données
Données collectées
Nous collectons uniquement les données strictement nécessaires :

Données d'identification : nom, prénom de l'enfant et des responsables légaux

Coordonnées : adresse email et téléphone pour les communications

Informations pédagogiques : progression académique, observations éducatives

Données administratives : informations médicales essentielles, allergies

Données techniques : adresse IP, cookies (pour le fonctionnement technique uniquement)

Base légale du traitement
Exécution du contrat de service éducatif

Consentement explicite pour les données optionnelles

Intérêt légitime pour la sécurité de la plateforme

Obligations légales (santé, sécurité)<br>

2. Utilisation des données
Finalités spécifiques
Gestion des inscriptions et admissions

Suivi pédagogique personnalisé

Communication avec les familles

Organisation des activités éducatives

Facturation et gestion administrative

Sécurité des enfants et du personnel

Amélioration des services éducatifs<br>

3. Partage des données
Principe fondamental
Aucun partage avec des tiers sans consentement explicite, sauf dans les cas limités suivants :

Exceptions légales
Autorités compétentes : uniquement sur demande légale (tribunaux, services de protection de l'enfance)

Prestataires techniques : sous-traitants liés par des clauses de confidentialité strictes (hébergement, maintenance)

Services d'urgence : en cas de nécessité médicale ou de sécurité immédiate

Personnel éducatif : accès limité aux données nécessaires à leurs fonctions<br>

4. Sécurité des données
Mesures techniques
Chiffrement des données sensibles (SSL/TLS)

Sauvegardes régulières sécurisées

Contrôles d'accès stricts (authentification à deux facteurs)

Audit régulier des systèmes

Mesures organisationnelles
Formation obligatoire du personnel à la protection des données

Procédures documentées de gestion des incidents

Désignation d'un délégué à la protection des données<br>

5. Droits des utilisateurs
Conformément au RGPD et à la loi française, vous disposez des droits suivants :

Droit d'accès : connaître les données détenues

Droit de rectification : corriger les informations inexactes

Droit à l'effacement : demander la suppression des données (sous conditions légales)

Droit à la limitation : restreindre temporairement le traitement

Droit d'opposition : s'opposer au traitement pour motifs légitimes

Droit à la portabilité : récupérer vos données dans un format structuré

Exercice de vos droits
Contactez notre délégué à la protection des données :

Email : contact@preschool.com

Courrier : [Adresse postale du responsable de traitement]

Réponse garantie sous 30 jours maximum<br>

6. Conservation des données
Durées spécifiques
Données des élèves : jusqu'à 3 ans après le départ, sauf obligation légale

Données comptables : 10 ans (obligation légale)

Données médicales : durée nécessaire pour la sécurité de l'enfant

Cookies techniques : durée de session ou 13 mois maximum<br>

7. Transferts internationaux
Principe
Vos données sont stockées dans l'Union Européenne. Tout transfert hors UE serait soumis à :

Décision d'adéquation de la Commission Européenne

Clauses contractuelles types

Consentement explicite préalable<br>

8. Protection des enfants
Dispositions spécifiques
Consentement parental obligatoire pour les mineurs de moins de 15 ans

Interface adaptée à la protection des données des enfants

Surveillance renforcée de l'accès aux données des mineurs<br>

9. Modifications de la politique
Nous nous engageons à :

Vous informer de toute modification substantielle

Conserver l'historique des versions

Ne pas réduire vos droits sans votre consentement<br>

10. Contact et réclamations
Contrôleur des données
PréSchool - [contact@preschool.com]
Responsable du traitement : [Toss Assouan]

Autorité de contrôle
CNIL (Commission Nationale de l'Informatique et des Libertés)
3 Place de Fontenoy, 75007 Paris
Site web : www.cnil.fr
            </p>
        </div>

        <footer>
            <p>&copy; 2026 PréSchool. Tous droits réservés.</p>
        </footer>
    </body>
</html>
