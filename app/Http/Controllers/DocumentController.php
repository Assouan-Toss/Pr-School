<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Formulaire d'ajout
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Enregistrer un document
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'required|file|mimes:pdf,doc,docx,ppt,pptx',
            'visible_pour' => 'required|in:eleves,professeurs,tous',
            'classe_id' => 'nullable|exists:classes,id',
            'matiere_id' => 'nullable|exists:matieres,id',
        ]);

        // Stockage correct sur le disque public
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

    /**
     * Télécharger un document
     */
    public function download(Document $document)
    {
        return Storage::disk('public')->exists($document->file_path);
        // Vérifier existence du fichier
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'Fichier non trouvé');
        }

        // Vérifier la visibilité
        $userRole = auth()->user()->role ?? null;

        if (
            $document->visible_pour !== 'tous' &&
            $document->visible_pour !== $userRole
        ) {
            abort(403, 'Accès non autorisé');
        }

        // Nom du fichier téléchargé
        $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
        $filename = $document->titre . '.' . $extension;

        return Storage::disk('public')->download(
            $document->file_path,
            $filename
        );
    }
}
