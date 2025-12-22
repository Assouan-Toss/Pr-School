@extends('layouts.app')

@section('title', 'Boîte de réception')

@section('content')
<div class="container mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Boîte de réception</h1>
        <a href="{{ route('messages.create') }}" class="btn btn-primary">Écrire un message</a>
    </div>

    @if($messages->isEmpty())
        <p class="text-gray-500">Aucun message reçu.</p>
    @else
        <div class="space-y-4">
            @foreach($messages as $message)
                <div class="border rounded-lg p-4 bg-white shadow">
                    <div class="flex justify-between items-center mb-2">
                        <strong>
                            De : {{ $message->expediteur->name }}
                        </strong>
                        <span class="text-sm text-gray-500">
                            {{ $message->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    <p class="text-gray-700">
                        {{ $message->contenu }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
