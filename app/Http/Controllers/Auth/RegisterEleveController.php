<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterEleveController extends Controller
{
    /**
     * Formulaire d'inscription
     */
    public function create()
    {
        $classes = Classe::all();
        return view('auth.inscription', compact('classes'));
    }

    /**
     * Traitement de l'inscription
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'classe_id' => 'required|exists:classes,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'eleve',
            'classe_id' => $request->classe_id,
        ]);

        return redirect()->route('connexion')
            ->with('success', 'Inscription réussie. Connectez-vous.');
    }
}
