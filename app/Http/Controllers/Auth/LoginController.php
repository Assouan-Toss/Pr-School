<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Redirection selon rôle
            if (auth()->user()->role === 'admin') {
                return redirect('/admin');
            }

            if (auth()->user()->role === 'professeur') {
                return redirect('/prof');
            }

            return redirect('/eleve');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ]);

    }

    // la fonction logout
    public function logout(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
