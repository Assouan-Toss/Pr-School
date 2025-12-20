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
}
