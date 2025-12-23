<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind (ou ton CSS) --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#1B13AD] text-white flex flex-col">
        <div class="p-6 text-xl font-bold border-b border-blue-400">
            Admin Panel
        </div>

        <nav class="flex-1 p-4 space-y-2">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-[#3D80DB]">
                Tableau de bord
            </a>

            <a href="/admin/eleves"
               class="block px-4 py-2 rounded hover:bg-[#3D80DB]">
                Gestion des élèves
            </a>

            <a href="/admin/professeurs"
               class="block px-4 py-2 rounded hover:bg-[#3D80DB]">
                Gestion des professeurs
            </a>

            <a href="/admin/classes"
               class="block px-4 py-2 rounded hover:bg-[#3D80DB]">
                Gestion des classes
            </a>

            <a href="/messages"
               class="block px-4 py-2 rounded hover:bg-[#3D80DB]">
                Messages
            </a>

        </nav>

        <!-- FOOTER -->
        <div class="p-4 border-t border-blue-400">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 hover:bg-red-600 rounded">
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>
