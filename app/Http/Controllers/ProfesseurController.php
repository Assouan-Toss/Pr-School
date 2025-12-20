<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfesseurController extends Controller
{
    public function index()
    {
        return view('prof.dashboard');
    }

    /** AJOUTER COURS */
    public function addCours(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'file' => 'required|file'
        ]);

        $path = $request->file('file')->store('documents', 'public');

        Document::create([
            'titre' => $request->titre,
            'file_path' => $path,
            'description' => $request->description,
            'publie_par' => auth()->id(),
            'visible_pour' => 'eleves',
            'classe_id' => auth()->user()->classe_id,
            'matiere_id' => $request->matiere_id
        ]);

        return back()->with('success', 'Cours ajouté.');
    }

    /** TELECHARGER DOCUMENT */
    public function downloadDocument($id)
    {
        $doc = Document::findOrFail($id);
        return Storage::disk('public')->download($doc->file_path);
    }

    /** GÉRER ÉLÈVES */
    public function manageEleves()
    {
        return view('prof.eleves', [
            'eleves' => User::where('classe_id', auth()->user()->classe_id)
                           ->where('role', 'eleve')->get()
        ]);
    }
}
