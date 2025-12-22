@extends('layouts.app')
@section('content')
@if($documents->count())

<style>
    .card {
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    background-color: #ffffff;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.card-body {
    padding: 20px;
}

.card-body h6 {
    margin-bottom: 8px;
    font-size: 1.1rem;
    color: #333;
}

.card-body .text-muted {
    margin-bottom: 16px;
    font-size: 0.9rem;
}

.btn-download {
    display: inline-block;
    background-color: #3D80DB;
    color: white;
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.3s ease;
    border: none;
    width: 100%;
    text-align: center;
}

.btn-download:hover {
    background-color: #2c62b0;
}

.row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: flex-start;
}

.col-md-4 {
    flex: 1 1 calc(33.333% - 20px);
    min-width: 250px;
}

.text-muted {
    color: #6c757d;
}

/* Responsive */
@media (max-width: 768px) {
    .col-md-4 {
        flex: 1 1 100%;
    }
}

</style>
    <div class="row mt-4">
        @foreach($documents as $doc)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $doc->titre }}</h6>
                        <p class="text-muted small">
                            Ajouté par {{ $doc->auteur->name ?? '—' }}
                        </p>
                        <a href="{{ route('documents.download', $doc->id) }}" 
                           class="btn-download"
                           download>
                            Télécharger
                        </a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-muted mt-4">Aucun document disponible.</p>
@endif
@endsection
