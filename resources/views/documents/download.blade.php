@extends('layouts.app')

@section('title', 'Télécharger le document')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Téléchargement du document</h4>
                </div>

                <div class="card-body">
                    <h5 class="card-title">{{ $document->titre }}</h5>

                    @if($document->description)
                        <p class="card-text text-muted">
                            {{ $document->description }}
                        </p>
                    @endif

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">
                            <strong>Auteur :</strong>
                            {{ $document->auteur->name ?? '—' }}
                        </li>

                        <li class="list-group-item">
                            <strong>Visibilité :</strong>
                            {{ ucfirst($document->visible_pour) }}
                        </li>

                        <li class="list-group-item">
                            <strong>Date de publication :</strong>
                            {{ $document->created_at->format('d/m/Y') }}
                        </li>
                    </ul>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('bibliotheque.index') }}"
                           class="btn btn-outline-secondary">
                            Retour à la bibliothèque
                        </a>

                        <a href="{{ route('documents.download', $doc) }}"
                           class="btn btn-primary">
                            Télécharger le fichier
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
