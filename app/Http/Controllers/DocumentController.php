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
        // Autorisation : Admin ou Professeur
        if (!in_array(auth()->user()->role, ['admin', 'professeur'])) {
            abort(403, 'Accès non autorisé');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,zip,rar|max:20480', // 20MB max
            'visible_pour' => 'required|in:eleves,professeurs,tous',
            'classe_id' => 'nullable|exists:classes,id',
            'matiere_id' => 'nullable|exists:matieres,id',
        ]);

        // Stockage correct sur le disque public
        $path = $request->file('file_path')->store('documents', 'public');

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
        // Construction du chemin absolu
        // storage_path('app/public') pointe vers /storage/app/public
        $filePath = storage_path('app/public/' . $document->file_path);

        // Vérification directe
        if (!file_exists($filePath)) {
            // Tentative de rattrapage si le chemin a été enregistré avec 'public/'
            $filePathRetry = storage_path('app/' . $document->file_path);
            if (file_exists($filePathRetry)) {
                $filePath = $filePathRetry;
            } else {
                abort(404, "Le fichier est introuvable sur le serveur.\nChemin cherché : " . $filePath);
            }
        }

        // Vérifier la visibilité
        $user = auth()->user();
        $userRole = $user->role ?? null;
        $canDownload = false;

        if ($document->visible_pour === 'tous') {
            $canDownload = true;
        } elseif ($document->visible_pour === $userRole) {
            $canDownload = true;
        } elseif ($document->visible_pour === 'classe' && $user->classe_id === $document->classe_id) {
            $canDownload = true;
        } elseif ($userRole === 'admin') {
            $canDownload = true;
        } elseif ($userRole === 'professeur' && $document->publie_par === $user->id) {
             $canDownload = true;
        }

        if (!$canDownload) {
             abort(403, 'Accès non autorisé');
        }

        // Enregistrer l'historique
        if (auth()->check()) {
            \DB::table('document_downloads')->insert([
                'user_id' => auth()->id(),
                'document_id' => $document->id,
                'downloaded_at' => now(),
            ]);
        }

        // Téléchargement direct
        return response()->download($filePath, $document->titre . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }
}
