<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Afficher le formulaire d’ajout de document
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Enregistrer le document
     */
public function store(Request $request)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string',
        'fichier' => 'required|file|mimes:pdf,doc,docx,ppt,pptx',
        'visible_pour' => 'required|in:eleves,professeurs,tous',
        'classe_id' => 'nullable|exists:classes,id',
        'matiere_id' => 'nullable|exists:matieres,id',
    ]);

    $path = $request->file('fichier')->store('documents', 'public');

    Document::create([
        'titre' => $request->titre,
        'description' => $request->description,
        'file_path' => $path,
        'visible_pour' => $request->visible_pour,
        'publie_par' => auth()->id(),
        'classe_id' => $request->classe_id,
        'matiere_id' => $request->matiere_id,
    ]);

    return redirect()
        ->route('bibliotheque.index')
        ->with('success', 'Document ajouté avec succès');
}

}
