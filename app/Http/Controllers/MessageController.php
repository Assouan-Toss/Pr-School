<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Boîte de réception
     */
    public function inbox()
    {
        $messages = Message::with('expediteur')
            ->where('receiver_id', auth()->id())
            ->latest()
            ->get();

        // marquer comme lus
        Message::where('receiver_id', auth()->id())
            ->where('status', 'non_lu')
            ->update(['status' => 'lu']);

        return view('messages.inbox', compact('messages'));
    }

    /**
     * Messages envoyés
     */
    public function sent()
    {
        $messages = Message::with('destinataire')
            ->where('sender_id', auth()->id())
            ->latest()
            ->get();

        return view('messages.sent', compact('messages'));
    }

    /**
     * Formulaire d’envoi
     */
    public function create()
    {
        // on exclut l'utilisateur connecté
        $users = User::where('id', '!=', auth()->id())->get();

        return view('messages.create', compact('users'));
    }

    /**
     * Envoi du message
     */
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'contenu' => 'required|string',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'contenu' => $request->contenu,
            'status' => 'non_lu',
        ]);

        return redirect()
            ->route('messages.sent')
            ->with('success', 'Message envoyé avec succès');
    }

    
}
