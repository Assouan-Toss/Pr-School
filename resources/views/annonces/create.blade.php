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
                    <input type="text" name="titre" class="form-control" required>
                </div>

                {{-- Contenu --}}
                <div class="mb-3">
                    <label class="form-label" style="color:#1B13AD;">Contenu</label>
                    <textarea name="contenu" rows="5" class="form-control" required></textarea>
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
