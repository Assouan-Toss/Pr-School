@extends('layouts.admin')

@section('title', 'Gestion des professeurs')

@section('content')
<div class="p-6 max-w-6xl mx-auto">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#1B13AD]">
            Gestion des professeurs
        </h1>
    </div>

    <!-- Formulaire d'ajout -->
    <div class="bg-white p-6 rounded shadow mb-8">
        <h2 class="text-lg font-semibold mb-4">Ajouter un professeur</h2>
        <form action="{{ route('admin.professeurs.add') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nom complet</label>
                <input type="text" name="name" required class="w-full border rounded p-2" placeholder="Ex: Jean Dupont">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" required class="w-full border rounded p-2" placeholder="jean@ecole.com">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Mot de passe</label>
                <input type="password" name="password" required class="w-full border rounded p-2" placeholder="******">
            </div>
            <div class="md:col-span-3">
                <button type="submit" class="bg-[#1B13AD] text-white px-4 py-2 rounded hover:bg-[#3D80DB]">
                    + Enregistrer le professeur
                </button>
            </div>
        </form>
    </div>

    <!-- Liste -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#3D80DB] text-white">
                <tr>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Classe Principale</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($profs as $prof)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 font-medium">{{ $prof->name }}</td>
                        <td class="p-3">{{ $prof->email }}</td>
                        <td class="p-3">
                            @if($prof->classe)
                                <span class="bg-green-100 text-green-800 py-1 px-2 rounded-full text-xs">
                                    {{ $prof->classe->nom }}
                                </span>
                            @else
                                <span class="text-gray-400 italic">Aucune</span>
                            @endif
                        </td>
                        <td class="p-3 text-right flex justify-end gap-2">
                            <!-- Formulaire de suppression -->
                            <form action="{{ route('admin.professeurs.delete', $prof->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold px-2">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">
                            Aucun professeur enregistré dans le système.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection