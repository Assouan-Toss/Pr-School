@extends('layouts.app', ['title' => 'Dashboard Professeur'])

@section('content')

<h2 class="text-2xl font-semibold mb-6">Bonjour Pr. {{ auth()->user()->name }}</h2>

<div class="grid grid-cols-3 gap-6">

    <a href="/cours" class="p-6 bg-white shadow rounded-lg border-l-8 border-green-500">
        <h3 class="text-lg font-semibold mb-2">Mes cours</h3>
        <p class="text-gray-600">Ajouter et gérer les cours.</p>
    </a>

    <a href="/messages" class="p-6 bg-white shadow rounded-lg border-l-8 border-blue-400">
        <h3 class="text-lg font-semibold mb-2">Messages</h3>
        <p class="text-gray-600">Communiquer avec les élèves.</p>
    </a>

    <a href="/bibliotheque" class="p-6 bg-white shadow rounded-lg border-l-8 border-purple-500">
        <h3 class="text-lg font-semibold mb-2">Bibliothèque</h3>
        <p class="text-gray-600">Documents pédagogiques.</p>
    </a>

</div>

@endsection
