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

                <li><a href="/dashboard" class="block hover:text-[var(--bleu-clair)]">🏠 Accueil</a></li>
                <li><a href="/annonces" class="block hover:text-[var(--bleu-clair)]">📢 Annonces</a></li>
                <li><a href="/messages" class="block hover:text-[var(--bleu-clair)]">💬 Messages</a></li>
                <li><a href="/bibliotheque" class="block hover:text-[var(--bleu-clair)]">📚 Bibliothèque</a></li>
                <li><a href="/cours" class="block hover:text-[var(--bleu-clair)]">📘 Cours</a></li>
                <li><a href="/resultats" class="block hover:text-[var(--bleu-clair)]">📄 Résultats</a></li>

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
