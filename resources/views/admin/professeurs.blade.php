@extends('layouts.app')

@section('title', 'Gestion des professeurs')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    
    <h1 class="text-2xl font-bold text-[#1B13AD] mb-6">
        Liste des professeurs
    </h1>

    <!-- Message de debug -->
    @php
        // Testez si la variable existe
        if(!isset($professeurs)) {
            echo '<div class="bg-yellow-100 border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                    <strong>Debug:</strong> $professeurs n\'est pas défini<br>
                    Vérifiez votre contrôleur ou route.
                  </div>';
            
            // Essayez de récupérer les données directement (solution temporaire)
            $professeurs = App\Models\User::where('role', 'professeur')->get();
        }
    @endphp

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#3D80DB] text-white">
                <tr>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($professeurs as $prof)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $prof->name }}</td>
                        <td class="p-3">{{ $prof->email }}</td>
                        <td class="p-3">
                            <button class="text-blue-600 hover:text-blue-800 mr-3">
                                Modifier
                            </button>
                            <button class="text-red-600 hover:text-red-800">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            Aucun professeur enregistré
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection