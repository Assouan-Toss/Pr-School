@extends('layouts.admin')

@section('title', 'Tableau de bord Admin')

@section('content')

<h1 class="text-3xl font-bold mb-8 text-[#1B13AD]">Tableau de bord Administrateur</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    
    <!-- Élèves -->
    <a href="{{ route('admin.eleves') }}"
       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border-l-4 border-[#3D80DB]">
        <h2 class="text-xl font-semibold mb-2">Gestion des élèves</h2>
        <p class="text-gray-600">Consulter et gérer les élèves</p>
    </a>

    <!-- Professeurs -->
    <a href="{{ route('admin.professeurs') }}"
       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border-l-4 border-[#3D80DB]">
        <h2 class="text-xl font-semibold mb-2">Gestion des professeurs</h2>
        <p class="text-gray-600">Ajouter et assigner des professeurs</p>
    </a>

    <!-- Classes -->
    <a href="{{ route('admin.classes') }}"
       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border-l-4 border-[#3D80DB]">
        <h2 class="text-xl font-semibold mb-2">Gestion des classes</h2>
        <p class="text-gray-600">Créer et modifier les classes</p>
    </a>

    <!-- Annonces -->
    <a href="{{ route('admin.annonces') }}"
       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border-l-4 border-[#3D80DB]">
        <h2 class="text-xl font-semibold mb-2">Annonces</h2>
        <p class="text-gray-600">Publier et gérer les annonces</p>
    </a>

    <!-- Bulletins -->
    <a href="{{ route('admin.bulletins.index') }}"
       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border-l-4 border-[#3D80DB]">
        <h2 class="text-xl font-semibold mb-2">Bulletins & Résultats</h2>
        <p class="text-gray-600">Gérer les bulletins scolaires</p>
    </a>

    <!-- Messages -->
    <a href="{{ route('messages.index') }}"
       class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border-l-4 border-[#3D80DB]">
        <h2 class="text-xl font-semibold mb-2">Messagerie</h2>
        <p class="text-gray-600">Communiquer avec professeurs et élèves</p>
    </a>

</div>

@endsection
