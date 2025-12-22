@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm" style="border-top:5px solid #1B13AD;">
        <div class="card-body">

            <h3 style="color:#1B13AD;">
                {{ $annonce->titre }}
            </h3>

            <p class="text-muted mb-3">
                Publiée le {{ $annonce->created_at->format('d/m/Y') }}
            </p>

            <hr>

            <p style="font-size:16px;">
                {{ $annonce->contenu }}
            </p>

            <hr>

            <a href="{{ route('annonces.index') }}" 
               class="btn text-white"
               style="background-color:#3D80DB;">
                ← Retour aux annonces
            </a>

            @if(auth()->user()->role !== 'eleve')
                <a href="{{ route('annonces.edit', $annonce->id) }}" 
                   class="btn btn-warning text-white">
                    Modifier
                </a>
            @endif

        </div>
    </div>

</div>
@endsection
