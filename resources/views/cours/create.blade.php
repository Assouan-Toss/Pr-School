@extends('layouts.app')

@section('content')

<div class="p-6 max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold text-[#1B13AD] mb-6">Ajouter un Cours</h1>

    <form action="{{ route('cours.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white shadow-lg rounded-xl p-6">

        @csrf

        <!-- Titre -->
        <label class="block font-semibold text-gray-800">Titre</label>
        <input type="text" name="titre"
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#3D80DB] mb-4"
               required>

        <!-- Description -->
        <label class="block font-semibold text-gray-800">Description</label>
        <textarea name="description" rows="4"
                  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#3D80DB] mb-4"
                  required></textarea>

        <!-- Fichier -->
        <label class="block font-semibold text-gray-800">Fichier (PDF, DOCX…)</label>
        <input type="file" name="fichier"
               class="w-full px-4 py-2 border rounded-lg mb-4">

        <!-- Bouton -->
        <button type="submit"
                class="w-full bg-[#1B13AD] text-white py-3 rounded-lg font-semibold hover:bg-[#3D80DB] transition">
            Enregistrer
        </button>

    </form>

</div>

@endsection
