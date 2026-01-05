@extends('layouts.admin')

@section('title', 'Ajouter un bulletin')

@section('content')
<div class="p-6 max-w-xl">

    <h1 class="text-2xl font-bold text-[#1B13AD] mb-6">
        Ajouter un bulletin
    </h1>

    <form action="{{ route('admin.bulletins.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-semibold">Élève</label>
            <select name="eleve_id" required class="w-full border rounded p-2">
                @foreach($eleves as $eleve)
                    <option value="{{ $eleve->id }}">
                        {{ $eleve->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Classe</label>
            <select name="classe_id" required class="w-full border rounded p-2">
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}">
                        {{ $classe->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Période</label>
            <input type="text"
                   name="periode"
                   placeholder="Ex: 1er trimestre"
                   required
                   class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Moyenne</label>
            <input type="number"
                   step="0.01"
                   name="moyenne"
                   class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Fichier (PDF)</label>
            <input type="file"
                   name="fichier"
                   accept="application/pdf"
                   required
                   class="w-full border rounded p-2">
        </div>

        <button class="bg-[#1B13AD] text-white px-4 py-2 rounded hover:bg-[#3D80DB]">
            Enregistrer
        </button>

    </form>

</div>
@endsection
