@extends('layouts.admin', ['title' => 'Dashboard Admin'])

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#1B13AD]">
            Gestion des bulletins
        </h1>

        <a href="{{ route('admin.bulletins.create') }}"
           class="bg-[#1B13AD] text-white px-4 py-2 rounded hover:bg-[#3D80DB]">
            + Ajouter un bulletin
        </a>
    </div>

    @if($bulletins->isEmpty())
        <div class="bg-white p-6 rounded shadow text-gray-500">
            Aucun bulletin enregistré.
        </div>
    @else
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-[#3D80DB] text-white">
                    <tr>
                        <th class="p-3 text-left">Élève</th>
                        <th class="p-3 text-left">Classe</th>
                        <th class="p-3 text-left">Période</th>
                        <th class="p-3 text-left">Moyenne</th>
                        <th class="p-3 text-left">Fichier</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bulletins as $bulletin)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">
                                {{ $bulletin->eleve->name }}
                            </td>
                            <td class="p-3">
                                {{ $bulletin->eleve->classe->nom ?? 'Non assigné' }}
                            </td>
                            <td class="p-3">
                                {{ $bulletin->semestre }}
                            </td>
                            <td class="p-3 font-semibold">
                                {{ $bulletin->moyenne ? $bulletin->moyenne . '/20' : '-' }}
                            </td>
                            <td class="p-3">
                                <a href="{{ asset('storage/'.$bulletin->file_path) }}"
                                   target="_blank"
                                   class="text-[#3D80DB] hover:underline">
                                    Télécharger
                                </a>
                            </td>
                            <td class="p-3 text-center flex gap-2 justify-center">

                                <form action="{{ route('admin.bulletins.destroy', $bulletin->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Supprimer ce bulletin ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">
                                        Supprimer
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
