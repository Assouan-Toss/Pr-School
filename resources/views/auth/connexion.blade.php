<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --bleu-fonce: #1B13AD;
            --bleu-clair: #3D80DB;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-lg p-10 w-full max-w-md">

        <div class="text-center mb-8">
            <img src="{{ asset('assets/2-removebg-preview.png') }}" alt="Logo" class="w-24 mx-auto">
            <h1 class="text-2xl font-bold text-[var(--bleu-fonce)] mt-4">PRESCHOOL</h1>
            <p class="text-gray-600">Portail de connexion</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('connexion.post') }}" method="POST">
            @csrf

            <!-- Email -->
            <label class="block mb-2 font-semibold text-gray-700">Adresse Email</label>
            <input type="email" name="email"
                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[var(--bleu-clair)]"
                   placeholder="exemple@email.com"
                   required>

            <!-- Mot de passe -->
            <label class="block mt-4 mb-2 font-semibold text-gray-700">Mot de passe</label>
            <input type="password" name="password"
                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[var(--bleu-clair)]"
                   placeholder="********"
                   required>

            <!-- Bouton -->
            <button type="submit"
                    class="mt-6 w-full bg-[var(--bleu-fonce)] text-white py-3 rounded-lg font-semibold hover:bg-[var(--bleu-clair)] transition">
                Se connecter
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Mot de passe oublié ? 
            <a href="#" class="text-[var(--bleu-clair)] hover:underline">Réinitialiser</a>
        </p>

    </div>

</body>
</html>
