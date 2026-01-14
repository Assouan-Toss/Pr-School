<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Document;
use App\Models\Bulletin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\EleveController;


class AdminController extends Controller
{
    /** DASHBOARD */
    public function index()
    {
        return view('admin.dashboard');
    }

    /** CREATION CLASSE */
    public function createClasse(Request $request)
    {
        $request->validate(['nom' => 'required', 'niveau' => 'required']);
        Classe::create($request->all());
        return back()->with('success', 'Classe créée.');
    }

    /** CREATION MATIERE */
    public function createMatiere(Request $request)
    {
        $request->validate(['nom' => 'required']);
        Matiere::create([
            'nom' => $request->nom,
            'professeur_id' => $request->professeur_id ?? null
        ]);
        return back()->with('success', 'Matière créée.');
    }

    /** AJOUT PROFESSEUR */
    public function addProf(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'role' => 'professeur',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'classe_id' => $request->classe_id
        ]);

        return back()->with('success', 'Professeur ajouté.');
    }

    /** AFFECTER MATIERE AU PROF */
    public function assignMatiere(Request $request)
    {
        $request->validate([
            'matiere_id' => 'required',
            'professeur_id' => 'required'
        ]);

        Matiere::find($request->matiere_id)->update([
            'professeur_id' => $request->professeur_id
        ]);

        return back()->with('success', 'Matière assignée.');
    }

    /** AFFECTER CLASSE AU PROF */
    public function assignClasse(Request $request)
    {
        $request->validate([
            'classe_id' => 'required',
            'professeur_id' => 'required'
        ]);

        User::find($request->professeur_id)->update([
            'classe_id' => $request->classe_id
        ]);

        return back()->with('success', 'Classe assignée au professeur.');
    }


    // ... (previous methods)

    /** SUSPENDRE UTILISATEUR */
    public function suspendUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_suspended' => true]);
        return back()->with('success', 'Utilisateur suspendu.');
    }

    /** ACTIVER UTILISATEUR */
    public function activateUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_suspended' => false]);
        return back()->with('success', 'Utilisateur réactivé.');
    }

    /** POSTER DOCUMENT AVEC TYPE */
    public function uploadDocument(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'file' => 'required|file',
            'type' => 'required|in:cours,roman,livre,autre'
        ]);

        $path = $request->file('file')->store('documents', 'public');

        Document::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'file_path' => $path,
            'visible_pour' => $request->visible_pour,
            'publie_par' => auth()->id(),
            'classe_id' => $request->classe_id,
            'matiere_id' => $request->matiere_id,
            'type' => $request->type
        ]);

        return back()->with('success', 'Document ajouté.');
    }


    /** TELECHARGER DOCUMENT */
    public function downloadDocument($id)
    {
        $doc = Document::findOrFail($id);
        return Storage::disk('public')->download($doc->file_path);
    }

    /** POSTER BULLETIN */
    public function uploadBulletin(Request $request)
    {
        $request->validate(['file' => 'required|file', 'eleve_id' => 'required']);

        $path = $request->file('file')->store('bulletins', 'public');

        Bulletin::create([
            'eleve_id' => $request->eleve_id,
            'semestre' => $request->semestre,
            'file_path' => $path,
            'publie_par' => auth()->id()
        ]);

        return back()->with('success', 'Bulletin publié.');
    }

    // AFFICHER LES BULLETINS
    public function bulletins()
    {
        return view('admin.bulletins.index', [
            'bulletins' => Bulletin::all()
        ]);
    }

    /** FORMULAIRE CREATION BULLETIN */
    public function createBulletin()
    {
        $eleves = User::where('role', 'eleve')->get();
        $classes = Classe::all();
        return view('admin.bulletins.create', compact('eleves', 'classes'));
    }

    /** ENREGISTRER BULLETIN */
    public function storeBulletin(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'eleve_id' => 'required|exists:users,id',
            'semestre' => 'required'
        ]);

        $path = $request->file('file')->store('bulletins', 'public');

        Bulletin::create([
            'eleve_id' => $request->eleve_id,
            'semestre' => $request->semestre,
            'file_path' => $path,
            'publie_par' => auth()->id()
        ]);

        return redirect()->route('admin.bulletins.index')->with('success', 'Bulletin publié.');
    }

    /** SUPPRIMER BULLETIN */
    public function destroyBulletin($id)
    {
        $bulletin = Bulletin::findOrFail($id);
        
        // Supprimer le fichier physique
        if (Storage::disk('public')->exists($bulletin->file_path)) {
            Storage::disk('public')->delete($bulletin->file_path);
        }

        $bulletin->delete();

        return back()->with('success', 'Bulletin supprimé.');
    }
    /** GERER ÉLÈVES */
    public function manageEleves()
    {
        return view('admin.eleves', [
            'eleves' => User::where('role', 'eleve')->get()
        ]);
    }

    /** GERER PROFESSEURS */
    public function manageProfesseurs()
    {
        return view('admin.professeurs', [
            'profs' => User::where('role', 'professeur')->get()
        ]);
    }

//     public function manageEleves()
// {
//     $eleves = User::where('role', 'eleve')->with('classe')->get();
//     return view('admin.eleves', compact('eleves'));
// }

// public function manageProfesseurs()
// {
//     $professeurs = User::where('role', 'professeur')->get();
//     return view('admin.professeurs', compact('professeurs'));
// }

// public function classes()
// {
//     $classes = Classe::all();
//     return view('admin.classes', compact('classes'));
// }

public function classes()
{
    $classes = Classe::all();
    return view('admin.classes.index', compact('classes'));
}

public function createClasses(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'niveau' => 'required'
    ]);

    Classe::create($request->only('nom', 'niveau'));

    return back()->with('success', 'Classe créée avec succès');
}


    public function annonces()
    {
        // Si vous avez un modèle Annonce
        // $annonces = Annonce::all();
        // return view('admin.annonces', compact('annonces'));
        
        return view('admin.annonces');
    }
    



}
