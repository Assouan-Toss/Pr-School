@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="color:#1B13AD;">📥 Boîte de réception</h3>
<!-- 
        <a href="{{ route('messages.sent') }}"
           class="btn btn-outline-primary">
            Messages envoyés
        </a> -->
        <a href="{{ route('messages.inbox') }}">Messages reçus</a>
        <a href="{{ route('messages.sent') }}">Messages envoyés</a>
        <a href="{{ route('messages.create') }}">Nouveau message</a>

    </div>

    @if($messages->count())
        <div class="list-group">
            @foreach($messages as $msg)
                <div class="list-group-item mb-2 shadow-sm">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $msg->expediteur->name }}</strong>
                        <small class="text-muted">
                            {{ $msg->created_at->format('d/m/Y H:i') }}
                        </small>
                    </div>

                    <p class="mb-1 mt-2">{{ $msg->contenu }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">Aucun message reçu.</p>
    @endif

</div>
@endsection
