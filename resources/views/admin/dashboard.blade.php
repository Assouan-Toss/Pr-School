@extends('layouts.admin', ['title' => 'Dashboard Admin'])

@section('content')

<h2 class="text-2xl font-semibold mb-6">Panneau Administratif</h2>

<div class="grid grid-cols-3 gap-6">

    <a href="/admin/eleves" class="p-6 bg-white shadow rounded-lg border-l-8 border-blue-500">
        <h3 class="text-lg font-semibold mb-2">Gérer Élèves</h3>
        <p class="text-gray-600">Ajouter / supprimer / modifier.</p>
    </a>

    <a href="/admin/professeurs" class="p-6 bg-white shadow rounded-lg border-l-8 border-green-500">
        <h3 class="text-lg font-semibold mb-2">Gérer Professeurs</h3>
        <p class="text-gray-600">Affectations matières & classes.</p>
    </a>

    <a href="/admin/bulletins" class="p-6 bg-white shadow rounded-lg border-l-8 border-purple-500">
        <h3 class="text-lg font-semibold mb-2">Bulletins</h3>
        <p class="text-gray-600">Publier et gérer les bulletins.</p>
    </a>

    <a href="/admin/bibliotheque" class="p-6 bg-white shadow rounded-lg border-l-8 border-orange-500">
        <h3 class="text-lg font-semibold mb-2">Bibliothèque</h3>
        <p class="text-gray-600">Livres et documents.</p>
    </a>

</div>

@endsection
