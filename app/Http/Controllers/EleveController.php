<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Bulletin;
use Illuminate\Support\Facades\Storage;

class EleveController extends Controller
{
    public function index()
    {
        return view('eleve.dashboard');
    }

    /** TELECHARGER DOCUMENT */
    public function downloadDocument($id)
    {
        $doc = Document::findOrFail($id);
        return Storage::disk('public')->download($doc->file_path);
    }

    /** VOIR BULLETINS */
    public function bulletins()
    {
        return view('eleve.bulletins', [
            'bulletins' => Bulletin::where('eleve_id', auth()->id())->get()
        ]);
    }

    /** VOIR ANNONCES (DOCUMENTS ADMIN) */
    public function annonces()
    {
        return view('eleve.annonces', [
            'documents' => Document::where('visible_pour', 'tous')
                                   ->orWhere('classe_id', auth()->user()->classe_id)
                                   ->get()
        ]);
    }



// Gestion des élèves
    // public function index()
    // {
    //     $eleves = Eleve::with('classe')->paginate(10);
    //     $classes = Classe::all();
        
    //     return view('eleves.index', compact('eleves', 'classes'));
    // }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'classe_id' => 'nullable|exists:classes,id',
        ]);
        
        $eleve = Eleve::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'), // Mot de passe par défaut
            'classe_id' => $request->classe_id,
        ]);
        
        return redirect()->route('gestion.eleves')
            ->with('success', 'Élève créé avec succès !');
    }
    
    public function update(Request $request, Eleve $eleve)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $eleve->id,
            'classe_id' => 'nullable|exists:classes,id',
        ]);
        
        $eleve->update([
            'name' => $request->name,
            'email' => $request->email,
            'classe_id' => $request->classe_id,
        ]);
        
        return redirect()->route('gestion.eleves')
            ->with('success', 'Élève mis à jour avec succès !');
    }
    
    public function destroy(Eleve $eleve)
    {
        $eleve->delete();
        
        return redirect()->route('gestion.eleves')
            ->with('success', 'Élève supprimé avec succès !');
    }
}
