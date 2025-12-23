@extends('layouts.app')

@section('title', 'Gestion des classes')

@section('content')
<div class="p-6 max-w-xl">

    <h1 class="text-2xl font-bold text-[#1B13AD] mb-6">
        Création des classes
    </h1>

    <!-- FORMULAIRE CLASSE -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">

        <form method="POST" action="/admin/classes/create">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1">
                    Nom de la classe
                </label>
                <input type="text" name="nom"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <button type="submit"
                    class="bg-[#3D80DB] hover:bg-[#1B13AD] text-white px-6 py-2 rounded">
                Créer la classe
            </button>
        </form>

    </div>

    <!-- LISTE DES CLASSES -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#3D80DB] text-white">
                <tr>
                    <th class="p-3 text-left">Classe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classes as $classe)
                    <tr class="border-b">
                        <td class="p-3">{{ $classe->nom }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-4 text-center text-gray-500">
                            Aucune classe créée
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
