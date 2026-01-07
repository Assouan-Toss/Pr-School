@extends('layouts.app', ['title' => 'Dashboard Admin'])

@section('content')

<h1 class="text-3xl font-bold mb-8">Tableau de bord Administrateur</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    

    <!-- Élèves -->
    <a href="{{ route('admin.eleves') }}"
       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold mb-2">Gestion des élèves</h2>
        <p class="text-gray-600">Consulter et gérer les élèves</p>
    </a>

    <!-- Professeurs -->
    <a href="{{ route('admin.professeurs') }}"
       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold mb-2">Gestion des professeurs</h2>
        <p class="text-gray-600">Ajouter et assigner des professeurs</p>
    </a>

    <!-- Classes -->
    <a href="{{ route('admin.classes') }}"
       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold mb-2">Gestion des classes</h2>
        <p class="text-gray-600">Créer et modifier les classes</p>
    </a>

    

    <!-- Annonces -->
    <!-- <a href="{{ route('admin.annonces') }}"
       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold mb-2">Annonces</h2>
        <p class="text-gray-600">Publier des annonces</p>
    </a> -->

    <!-- Bulletins -->
    <!-- <a href="{{ route('admin.bulletins.index') }}"
       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold mb-2">Bulletins</h2>
        <p class="text-gray-600">Gérer les bulletins scolaires</p>
    </a> -->

    <!-- Messages -->
    <!-- <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-2">Messages</h2>
        <p class="text-gray-600 mb-4">Envoyer un message</p>

        <form method="POST" action="{{ route('admin.message.send') }}">
            @csrf
            <input
                type="text"
                name="message"
                placeholder="Votre message"
                class="w-full border rounded px-3 py-2 mb-2"
            >

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Envoyer
            </button>
        </form>
    </div> -->

</div>

@endsection
