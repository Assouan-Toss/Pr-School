@extends('layouts.app', ['title' => 'Dashboard Élève'])

@section('content')

<h2 class="text-2xl font-semibold mb-6">Bonjour {{ auth()->user()->name }}</h2>

<!-- CARDS SECTIONS -->
<div class="grid grid-cols-3 gap-6">

    <a href="/annonces" class="p-6 bg-white shadow rounded-lg border-l-8 border-[var(--bleu-clair)]">
        <h3 class="text-lg font-semibold mb-2">Annonces</h3>
        <p class="text-gray-600">Voir les nouvelles annonces de l’établissement.</p>
    </a>

    <a href="/cours" class="p-6 bg-white shadow rounded-lg border-l-8 border-green-500">
        <h3 class="text-lg font-semibold mb-2">Cours</h3>
        <p class="text-gray-600">Accès aux cours de la classe.</p>
    </a>

    <a href="/bibliotheque" class="p-6 bg-white shadow rounded-lg border-l-8 border-purple-500">
        <h3 class="text-lg font-semibold mb-2">Bibliothèque</h3>
        <p class="text-gray-600">Livres, romans et documents.</p>
    </a>

</div>

<!-- BULLETINS -->
<h3 class="mt-10 mb-3 text-xl font-semibold">Bulletins</h3>

<div class="bg-white p-6 rounded shadow">
    <p class="text-gray-600">Vos bulletins seront affichés ici.</p>
</div>

@endsection
