@extends('layouts.app')

@section('title', 'Gestion des professeurs')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold text-[#1B13AD] mb-6">
        Gestion des professeurs
    </h1>

    <!-- AJOUT PROFESSEUR -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">
            Ajouter un professeur
        </h2>

        <form method="POST" action="/admin/professeurs/add">
            @csrf

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="block font-semibold mb-1">Nom</label>
                    <input type="text" name="name" required
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block font-semibold mb-1">Email</label>
                    <input type="email" name="email" required
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block font-semibold mb-1">Mot de passe</label>
                    <input type="password" name="password" required
                           class="w-full border rounded p-2">
                </div>

            </div>

            <button type="submit"
                    class="mt-4 bg-[#3D80DB] hover:bg-[#1B13AD] text-white px-6 py-2 rounded">
                Ajouter
            </button>
        </form>
    </div>

    <!-- LISTE PROFESSEURS -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#3D80DB] text-white">
                <tr>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse($professeurs as $prof)
                    <tr class="border-b">
                        <td class="p-3">{{ $prof->name }}</td>
                        <td class="p-3">{{ $prof->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="p-4 text-center text-gray-500">
                            Aucun professeur
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
