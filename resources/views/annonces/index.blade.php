@extends('layouts.app')

@section('content')
<style>
    .container {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    color: #1B13AD;
    margin-bottom: 20px;
}

.btn-create {
    background-color: #3D80DB;
    color: white;
    border-radius: 8px;
    padding: 10px 20px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.btn-create:hover {
    background-color: #2c62b0;
}

.card {
    border-top: 4px solid #1B13AD;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    background-color: #ffffff;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.card-title {
    color: #1B13AD;
    margin-bottom: 10px;
    font-size: 1.1rem;
}

.card-text {
    color: #6c757d;
    margin-bottom: 10px;
}

.text-muted {
    color: #6c757d;
    font-size: 12px;
}

.btn-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.btn-group .btn {
    flex: 1;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.9rem;
    transition: background-color 0.3s ease;
}

.btn-group .btn-sm {
    padding: 6px 10px;
    font-size: 0.8rem;
}

.btn-primary {
    background-color: #3D80DB;
    color: white;
}

.btn-primary:hover {
    background-color: #2c62b0;
}

.btn-warning {
    background-color: #f39c12;
    color: white;
}

.btn-warning:hover {
    background-color: #e67e22;
}

.btn-danger {
    background-color: #e74c3c;
    color: white;
}

.btn-danger:hover {
    background-color: #c0392b;
}

/* Responsive */
@media (max-width: 768px) {
    .col-md-4 {
        flex: 1 1 100%;
    }
}

</style>

<h2 class="mb-4">Annonces</h2>
<div class="container mt-4">
    

    @if(auth()->user()->role === 'professeur' || auth()->user()->role === 'admin')
        <a href="{{ route('annonces.create') }}" class="btn-create mb-3">
            Créer une annonce
        </a>
    @endif

    <div class="row">
        @forelse($annonces as $annonce)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $annonce->titre }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($annonce->contenu, 100) }}
                        </p>
                        <p class="text-muted">
                            Publié le : {{ $annonce->created_at->format('d/m/Y') }}
                        </p>
                        <div class="btn-group">
                            <a href="{{ route('annonces.show', $annonce->id) }}" class="btn btn-primary btn-sm">
                                Voir plus
                            </a>
                            @if(auth()->user()->role !== 'eleve')
                                <a href="{{ route('annonces.edit', $annonce->id) }}" class="btn btn-warning btn-sm">
                                    Modifier
                                </a>
                                <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Supprimer
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Aucune annonce disponible.</p>
        @endforelse
    </div>
</div>
@endsection
