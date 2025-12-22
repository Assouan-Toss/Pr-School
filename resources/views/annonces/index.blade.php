@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4" style="color:#1B13AD;">Annonces</h2>

    {{-- Bouton ajouter (visible pour professeurs et admins) --}}
    @if(auth()->user()->role === 'professeur' || auth()->user()->role === 'admin')
        <a href="{{ route('annonces.create') }}" 
            class="btn text-white mb-3" 
            style="background-color:#3D80DB;">
            Créer une annonce
        </a>
    @endif

    {{-- Liste des annonces --}}
    <div class="row">
        @forelse($annonces as $annonce)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm" style="border-top:4px solid #1B13AD;">
                    <div class="card-body">
                        <h5 class="card-title" style="color:#1B13AD;">{{ $annonce->titre }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($annonce->contenu, 100) }}
                        </p>
                        <p class="text-muted" style="font-size:12px;">
                            Publié le : {{ $annonce->created_at->format('d/m/Y') }}
                        </p>
                        <a href="{{ route('annonces.show', $annonce->id) }}" 
                            class="btn btn-sm text-white"
                            style="background-color:#3D80DB;">
                            Voir plus
                        </a>

                        @if(auth()->user()->role !== 'eleve')
                            <a href="{{ route('annonces.edit', $annonce->id) }}"
                                class="btn btn-sm btn-warning text-white">
                                Modifier
                            </a>
                            <form action="{{ route('annonces.destroy', $annonce->id) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Supprimer
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Aucune annonce disponible.</p>
        @endforelse
    </div>

</div>
@endsection
