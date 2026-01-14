@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.app')

@section('title', 'Bulletins')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold text-[#1B13AD] mb-6">
        Bulletins scolaires
    </h1>
    

    @if($bulletins->isEmpty())
        <div class="bg-white p-6 rounded shadow text-gray-500">
            Aucun bulletin disponible.
        </div>
    @else
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-[#3D80DB] text-white">
                    <tr>
                        <th class="p-3 text-left">Élève</th>
                        <th class="p-3 text-left">Classe</th>
                        <th class="p-3 text-left">Période</th>
                        <th class="p-3 text-left">Moyenne</th>
                        <th class="p-3 text-left">Bulletin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bulletins as $bulletin)
                        <tr class="border-b">
                            <td class="p-3">
                                {{ $bulletin->eleve->name }}
                            </td>
                            <td class="p-3">
                                {{ $bulletin->classe->nom }}
                            </td>
                            <td class="p-3">
                                {{ $bulletin->periode }}
                            </td>
                            <td class="p-3 font-semibold">
                                {{ $bulletin->moyenne ?? '-' }}
                            </td>
                            <td class="p-3">
                                <a href="{{ asset('storage/'.$bulletin->fichier) }}"
                                   target="_blank"
                                   class="text-[#3D80DB] font-semibold hover:underline">
                                    Télécharger
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
