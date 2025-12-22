<?php

namespace App\Http\Controllers;

use App\Models\Document;

class BibliothequeController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->get();
        return view('bibliotheque.index', compact('documents'));
    }
}
