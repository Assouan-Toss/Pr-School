@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4" style="color:#1B13AD;">Créer une annonce</h2>

    <div class="card shadow-sm" style="border-top:4px solid #3D80DB;">
        <div class="card-body">

            <form method="POST" action="{{ route('annonces.store') }}">
                @csrf

                {{-- Titre --}}
                <div class="mb-3">
                    <label class="form-label" style="color:#1B13AD;">Titre</label>
                    <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre') }}" required>
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Contenu --}}
                <div class="mb-3">
                    <label class="form-label" style="color:#1B13AD;">Contenu</label>
                    <textarea name="contenu" rows="5" class="form-control @error('contenu') is-invalid @enderror" required>{{ old('contenu') }}</textarea>
                    @error('contenu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Visibilité --}}
                <div class="mb-3">
                    <label class="form-label" style="color:#1B13AD;">Visibilité</label>
                    <select name="visible_pour" class="form-control @error('visible_pour') is-invalid @enderror" required>
                        <option value="">Sélectionner la visibilité</option>
                        <option value="tous" {{ old('visible_pour') == 'tous' ? 'selected' : '' }}>Tous</option>
                        <option value="professeurs" {{ old('visible_pour') == 'professeurs' ? 'selected' : '' }}>Professeurs</option>
                        <option value="eleves" {{ old('visible_pour') == 'eleves' ? 'selected' : '' }}>Élèves</option>
                        <option value="classe" {{ old('visible_pour') == 'classe' ? 'selected' : '' }}>Classe spécifique</option>
                    </select>
                    @error('visible_pour')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Classe (optionnel) --}}
                <div class="mb-3">
                    <label class="form-label" style="color:#1B13AD;">Classe (si visibilité = classe spécifique)</label>
                    <select name="classe_id" class="form-control @error('classe_id') is-invalid @enderror">
                        <option value="">Sélectionner une classe</option>
                        @foreach(App\Models\Classe::all() as $classe)
                            <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>{{ $classe->nom }}</option>
                        @endforeach
                    </select>
                    @error('classe_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" 
                        class="btn text-white"
                        style="background-color:#3D80DB;">
                    Publier
                </button>

            </form>

        </div>
    </div>

</div>
@endsection