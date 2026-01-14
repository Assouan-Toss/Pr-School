@extends('layouts.admin')

@section('title', 'Gestion des annonces')

@section('content')
<div class="p-6 max-w-6xl mx-auto">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#1B13AD]">
            Gestion des annonces
        </h1>
        <a href="{{ route('annonces.create') }}" class="bg-[#3D80DB] text-white px-4 py-2 rounded hover:bg-[#1B13AD] transition-colors">
            + Créer une annonce
        </a>
    </div>

    <!-- Liste -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#3D80DB] text-white">
                <tr>
                    <th class="p-3 text-left">Titre</th>
                    <th class="p-3 text-left">Extrait</th>
                    <th class="p-3 text-left">Date de publication</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($annonces as $annonce)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 font-medium">{{ $annonce->titre }}</td>
                        <td class="p-3 text-gray-600">{{ Str::limit($annonce->contenu, 50) }}</td>
                        <td class="p-3 text-sm">
                            {{ $annonce->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="p-3 text-right flex justify-end gap-2">
                            <a href="{{ route('annonces.edit', $annonce->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold px-2">
                                Modifier
                            </a>
                            <!-- Formulaire de suppression -->
                            <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?');">
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
                            Aucune annonce publiée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
