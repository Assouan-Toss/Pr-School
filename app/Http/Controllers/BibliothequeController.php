<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class BibliothequeController extends Controller
{
    public function index()
    {
        $documents = Document::with('auteur')->latest()->get();
        return view('bibliotheque.index', compact('documents'));
    }
    
    public function download($id)
{
    $document = Document::findOrFail($id);
    
    // Chemin correct pour storage
    $path = 'public/' . $document->chemin; // ou simplement $document->chemin
    
    if (!Storage::exists($path)) {
        // Essayer sans 'public/'
        $path = $document->chemin;
    }
    
    if (!Storage::exists($path)) {
        abort(404, 'Fichier non trouvé');
    }
    
    return Storage::download($path, $document->nom_fichier ?? 'document.pdf');
}

// public function download($id)
// {
//     \Log::info('Download attempt', [
//         'user' => auth()->id(),
//         'document_id' => $id,
//         'ip' => request()->ip()
//     ]);

// }

}