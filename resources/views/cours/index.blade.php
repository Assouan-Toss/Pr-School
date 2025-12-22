@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- Titre -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-[#1B13AD]">Mes Cours</h1>

        @if(auth()->user()->role === 'professeur')
            <a href="{{ route('cours.create') }}"
               class="px-4 py-2 rounded-lg bg-[#1B13AD] text-white font-semibold hover:bg-[#3D80DB] transition">
                Ajouter un cours
            </a>
        @endif
    </div>

    <!-- Liste des cours -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($cours as $c)
            <div class="bg-white rounded-xl shadow-md p-5 border-t-4 border-[#1B13AD]">

                <h2 class="text-lg font-bold text-gray-800 mb-2">
                    {{ $c->titre }}
                </h2>

                <p class="text-gray-600 text-sm mb-3">
                    {{ Str::limit($c->description, 120) }}
                </p>

                <div class="flex items-center justify-between mt-4">

                    <a href="{{ route('cours.show', $c->id) }}"
                       class="text-[#3D80DB] font-semibold hover:underline">
                        Voir plus
                    </a>

                    @if($c->fichier)
                        <a href="{{ asset('storage/cours/'.$c->fichier) }}"
                           download
                           class="px-3 py-1 bg-[#3D80DB] text-white rounded hover:bg-[#1B13AD] transition text-sm">
                            Télécharger
                        </a>
                    @endif
                </div>

            </div>
        @empty

            <div class="col-span-3 bg-white shadow p-6 text-center rounded-lg">
                <p class="text-gray-600">Aucun cours disponible pour le moment.</p>
            </div>

        @endforelse

    </div>

</div>

@endsection
