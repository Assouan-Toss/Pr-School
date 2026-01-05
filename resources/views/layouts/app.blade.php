<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --bleu-fonce: #1B13AD;
            --bleu-clair: #3D80DB;
            --blanc: #FFFFFF;
        }

        
        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #3D80DB;
            color: white;
            margin-top: 40px;
            border-radius: 15px 15px 0 0;
        }

        footer p {
            margin: 0;
        }


        .logo {
            height: 150px;
            align-items: center;
            margin: 0 auto;
            margin-bottom: 0 auto;
        }


        .dachb {
            width: 24px;
            height: 24px;
            object-fit: contain;
            flex-shrink: 0; /* Empêche l'icône de se rétrécir */
        }

        .side {
            display: flex;
            align-items: center; /* Aligne verticalement au centre */
            gap: 12px; /* Espacement constant entre l'icône et le texte */
            font-size: 1.2rem;
            /* padding: 8px 12px; */
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .side:hover {
            background-color: rgba(61, 128, 219, 0.1);
        }

        .side a {
            display: flex;
            align-items: center;
            gap: 12px;
            /* width: 100%; */
            text-decoration: none;
            color: inherit;
        }

        /* Pour s'assurer que tous les textes ont la même taille */
        .side a span {
            flex-grow: 1;
            white-space: nowrap; /* Empêche le texte de passer à la ligne */
        }

        nav ul {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        nav ul li {
            width: 100%;
        }

        /* Style pour le bouton de déconnexion */
        .border-t {
            margin-top: auto; /* Pousse le footer en bas */
        }

        .border-t button {
            display: flex;
            align-items: center;
            justify-content: center;
            /* gap: 10px; */
            /* width: 100%; */
            padding: 10px 16px;
            background-color: transparent;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        .border-t button:hover {
            background-color: #b91c1c;
        }

        /* Pour ajouter une icône de déconnexion */
        .border-t button::before {
            content: "";
            font-size: 16px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .side {
                padding: 6px 10px;
                gap: 10px;
            }
            
            .dachb {
                width: 20px;
                height: 20px;
            }
            
            .side a {
                font-size: 0.9rem;
            }
        }
</style>
</head>

<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[var(--bleu-fonce)] text-white flex flex-col">
        
        <div class="p-4 text-center border-b border-white/30">
            <img src="{{ asset('/assets/removebg-blanc.png') }}" class="logo" alt="Logo">
            <!-- <h2 class="mt-2 font-semibold text-lg">PRESCHOOL</h2> -->
            <p class="text-sm opacity-80">{{ auth()->user()->classe->nom ?? '' }}</p>
        </div>

        <nav class="flex-1 px-4 py-6">
            <ul class="space-y-4 text-md">

                <li class="side"><a href="/dashboard" class="block hover:text-[var(--bleu-clair)]"><img src="{{ asset('assets/icons8-dashboard-50.png') }}" class="dachb" alt="dashboard">Dashboard</a></li>
                <li class="side"><a href="/annonces" class="block hover:text-[var(--bleu-clair)]"><img src="{{ asset('assets/icons8-ads-48.png') }}" class="dachb" alt="annonces">Annonces</a></li>
                <li class="side"><a href="/messages" class="block hover:text-[var(--bleu-clair)]"><img src="{{ asset('assets/icons8-message-50.png') }}" class="dachb" alt="messages">Messages</a></li>
                <li class="side"><a href="/bibliotheque" class="block hover:text-[var(--bleu-clair)]"><img src="{{ asset('assets/icons8-books-50.png') }}" class="dachb" alt="bibliotheque">Bibliothèque</a></li>
                <li class="side"><a href="/cours" class="block hover:text-[var(--bleu-clair)]"><img src="{{ asset('assets/icons8-book-50.png') }}" class="dachb" alt="cours">Cours</a></li>
                <li class="side"><a href="/bulletins" class="block hover:text-[var(--bleu-clair)]"><img src="{{ asset('assets/icons8-quiz-48.png') }}" class="dachb" alt="resultats">Résultats</a></li>

                  <!-- FOOTER -->
        <div class="p-4 border-t border-blue-400">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 hover:bg-red-600 rounded">
                    Déconnexion
                </button>
            </form>
        </div>
    
        </nav>
    </aside>

    <!-- CONTENU CENTRAL -->
    <main class="flex-1 flex flex-col">

        <!-- TOP BAR -->
        <header class="bg-[var(--bleu-clair)] text-white flex justify-between items-center px-6 py-3 shadow">
            <!-- logo de notification -->
            <div class="flex items-center gap-4">
                <span class="text-2xl font-semibold">🔔</span>
                <span class="text-lg">0</span>
            </div>

            <h1 class="text-xl font-semibold">{{ $title ?? 'Dashboard' }}</h1>

            <div class="flex items-center gap-4">
                <span>{{ auth()->user()->name }}</span>
                <div class="w-10 h-10 rounded-full bg-white"></div>
            </div>

        </header>

        <!-- CONTENU -->
        <div class="p-6 overflow-y-auto">
            @yield('content')
        </div>

    </main>
</div>

<!-- FOOTER -->

        <footer>
            <p>&copy; 2023 PréSchool. Tous droits réservés.</p>
        </footer>

</body>
</html>
