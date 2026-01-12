<?php

namespace App\Http\Controllers;

use App\Models\Document;

class BibliothequeController extends Controller
{
    /**
     * Liste des documents
     */
    public function index()
    {
        $documents = Document::with('auteur')
            ->latest()
            ->get();

        return view('bibliotheque.index', compact('documents'));
    }
}
