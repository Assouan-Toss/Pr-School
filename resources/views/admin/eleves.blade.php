@extends('layouts.admin')

@section('title', 'Gestion des élèves')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold text-[#1B13AD] mb-6">
        Gestion des élèves
    </h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#3D80DB] text-white">
                <tr>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Classe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($eleves as $eleve)
                    <tr class="border-b">
                        <td class="p-3">{{ $eleve->name }}</td>
                        <td class="p-3">{{ $eleve->email }}</td>
                        <td class="p-3">
                            {{ $eleve->classe->nom ?? 'Non affectée' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            Aucun élève enregistré
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
