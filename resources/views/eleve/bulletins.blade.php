@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="font-weight-bold text-primary">
                <i class="fas fa-graduation-cap"></i> Mes Bulletins & Résultats
            </h2>
            <p class="text-muted">Consultez et téléchargez vos bulletins scolaires.</p>
        </div>
    </div>

    @if($bulletins->count() > 0)
        <div class="row">
            @foreach($bulletins as $bulletin)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <div class="mb-3 text-primary">
                                <i class="fas fa-file-alt fa-3x"></i>
                            </div>
                            <h5 class="card-title font-weight-bold">Semestre {{ $bulletin->semestre }}</h5>
                            <p class="card-text text-muted">
                                Publié le {{ $bulletin->created_at->format('d/m/Y') }}
                            </p>
                            <a href="{{ Storage::url($bulletin->file_path) }}" class="btn btn-outline-primary btn-block" download>
                                <i class="fas fa-download"></i> Télécharger
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle fa-2x mb-3"></i><br>
            Aucun bulletin n'est disponible pour le moment.
        </div>
    @endif
</div>
@endsection
