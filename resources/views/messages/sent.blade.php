@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="color:#1B13AD;">📤 Messages envoyés</h3>

        <a href="{{ route('messages.inbox') }}"
           class="btn btn-outline-primary">
            Boîte de réception
        </a>
    </div>

    @if($messages->count())
        <div class="list-group">
            @foreach($messages as $msg)
                <div class="list-group-item mb-2 shadow-sm">
                    <div class="d-flex justify-content-between">
                        <strong>À : {{ $msg->destinataire->name }}</strong>
                        <small class="text-muted">
                            {{ $msg->created_at->format('d/m/Y H:i') }}
                        </small>
                    </div>

                    <p class="mb-1 mt-2">{{ $msg->contenu }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">Aucun message envoyé.</p>
    @endif

</div>
@endsection
