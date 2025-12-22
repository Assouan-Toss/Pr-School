@extends('layouts.app')

@section('content')

<div class="p-6 max-w-3xl mx-auto">

    <div class="bg-white shadow-lg rounded-xl p-6">

        <h1 class="text-2xl font-bold text-[#1B13AD] mb-3">
            {{ $cours->titre }}
        </h1>

        <p class="text-gray-700 mb-4">
            {{ $cours->description }}
        </p>

        @if($cours->fichier)
            <a href="{{ asset('storage/cours/'.$cours->fichier) }}"
               download
               class="px-4 py-2 bg-[#3D80DB] text-white rounded-lg hover:bg-[#1B13AD] transition">
                Télécharger le fichier
            </a>
        @endif

    </div>

</div>

@endsection
