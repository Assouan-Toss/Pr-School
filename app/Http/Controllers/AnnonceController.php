<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    /**
     * Afficher la liste des annonces (tous les rôles).
     */
    public function index(Request $request)
    {
        $query = Annonce::query();

        // Filtre par date
        if ($request->has('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Filtre par classe (si applicable)
        if ($request->has('classe_id')) {
            $query->where('classe_id', $request->classe_id);
        }

        // Visibilité
        if (auth()->check()) {
            $user = auth()->user();
            $query->where(function($q) use ($user) {
                $q->where('visible_pour', 'tous')
                  ->orWhere('visible_pour', $user->role);
                
                // Only add classe_id condition if user has a classe_id
                if ($user->classe_id) {
                    $q->orWhere('classe_id', $user->classe_id);
                }
            });
        }

        $annonces = $query->orderBy('created_at', 'desc')->get();
        return view('annonces.index', compact('annonces'));
    }

    /**
     * Formulaire de création (admin + professeur).
     */
    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'professeur'])) {
            abort(404);
        }
        
        $classes = \App\Models\Classe::all();
        return view('annonces.create', compact('classes'));
    }

    /**
     * Enregistrer une annonce.
     */
    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'professeur'])) {
            abort(404);
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'visible_pour' => 'required|in:tous,professeurs,eleves,classe',
            'classe_id' => 'nullable|required_if:visible_pour,classe|exists:classes,id'
        ]);

        Annonce::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'user_id' => auth()->id(),
            'visible_pour' => $request->visible_pour,
            'classe_id' => $request->classe_id,
        ]);

        return redirect()->route('annonces.index')->with('success', 'Annonce publiée.');
    }

    /**
     * Affichage d’une annonce (tout le monde).
     */
    public function show($id)
    {
        $annonce = Annonce::findOrFail($id);
        return view('annonces.show', compact('annonce'));
    }

    /**
     * Formulaire de modification (admin + professeur).
     */
    public function edit($id)
    {
        $annonce = Annonce::findOrFail($id);

        if (!in_array(auth()->user()->role, ['admin', 'professeur'])) {
            abort(404);
        }

        return view('annonces.edit', compact('annonce'));
    }

    /**
     * Mise à jour d’une annonce.
     */
    public function update(Request $request, $id)
    {
        $annonce = Annonce::findOrFail($id);

        if (!in_array(auth()->user()->role, ['admin', 'professeur'])) {
            abort(404);
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
        ]);

        $annonce->update([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('annonces.index')->with('success', 'Annonce mise à jour.');
    }

    /**
     * Supprimer une annonce (admin + professeur).
     */
    public function destroy($id)
    {
        $annonce = Annonce::findOrFail($id);

        if (!in_array(auth()->user()->role, ['admin', 'professeur'])) {
            abort(404);
        }

        $annonce->delete();

        return redirect()->route('annonces.index')->with('success', 'Annonce supprimée.');
    }
}
