<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Afficher le formulaire d'ajout de document
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

    /**
     * Télécharger un document
     */
    public function download(Document $document)
    {
        // Vérifier si le fichier existe
        $path = Storage::disk('public')->path($document->file_path);
        
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'Fichier non trouvé');
        }

        // Optionnel : Vérifier les permissions de visibilité
        $userRole = auth()->user()->role ?? 'visiteur';
        // Vérifier si l'utilisateur a le droit d'accéder au document
        $allowedRoles = ['eleves', 'professeurs', 'tous'];
        
        if (!in_array($userRole, $allowedRoles) || 
            !in_array($document->visible_pour, ['tous', $userRole])) {
            abort(403, 'Accès non autorisé');
        }

        // Récupérer le nom original du fichier si disponible
        $originalName = $document->titre . '.' . pathinfo($path, PATHINFO_EXTENSION);
        
        return Storage::disk('public')->download(
            $document->file_path, 
            $originalName,
            [
                'Content-Type' => 'application/octet-stream',
            ]
        );
    }
}
