<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    /**
     * Afficher la liste des annonces (tous les rôles).
     */
    public function index()
    {
        $annonces = Annonce::orderBy('created_at', 'desc')->get();
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

        return view('annonces.create');
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
        ]);

        Annonce::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'user_id' => auth()->id(),
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
