<form method="POST" action="{{ route('eleve.register.store') }}">
    @csrf

    <!-- Nom -->
    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Nom complet
        </label>
        <input type="text"
               name="name"
               value="{{ old('name') }}"
               required
               class="w-full border rounded p-2">
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Adresse email
        </label>
        <input type="email"
               name="email"
               value="{{ old('email') }}"
               required
               class="w-full border rounded p-2">
    </div>

    <!-- rôle -->
    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Classe
        </label>
        <select name="classe_id"
                required
                class="w-full border rounded p-2">
            <option value="">-- Choisir une classe --</option>
            @foreach($classes as $classe)
                <option value="{{ $classe->id }}"
                    {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                    {{ $classe->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Mot de passe -->
    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Mot de passe
        </label>
        <input type="password"
               name="password"
               required
               class="w-full border rounded p-2">
    </div>

    <!-- Confirmation -->
    <div class="mb-6">
        <label class="block mb-1 font-semibold">
            Confirmation du mot de passe
        </label>
        <input type="password"
               name="password_confirmation"
               required
               class="w-full border rounded p-2">
    </div>

    <!-- Bouton -->
    <button type="submit"
            class="w-full bg-[#3D80DB] hover:bg-[#1B13AD] text-white py-2 rounded">
        S’inscrire
    </button>
</form>
