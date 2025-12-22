<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    public function index()
    {
        $cours = Cours::all();
        return view('cours.index', compact('cours'));
    }

    public function show($id)
    {
        $cours = Cours::findOrFail($id);
        return view('cours.show', compact('cours'));
    }

    public function create()
    {
        return view('cours.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'fichier' => 'nullable|file|max:20480'
        ]);

        $cours = new Cours();
        $cours->titre = $request->titre;
        $cours->description = $request->description;

        if ($request->hasFile('fichier')) {
            $cours->fichier = $request->file('fichier')->store('cours', 'public');
        }

        $cours->save();

        return redirect()->route('cours.index')->with('success', 'Cours ajouté avec succès.');
    }
}
