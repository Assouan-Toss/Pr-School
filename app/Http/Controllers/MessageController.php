<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'contenu' => 'required'
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'contenu' => $request->contenu,
            'status' => 'non_lu'
        ]);

        return back()->with('success', 'Message envoyé.');
    }

    public function inbox()
    {
        return view('messages.inbox', [
            'messages' => Message::where('receiver_id', auth()->id())->get()
        ]);
    }

    public function sent()
    {
        return view('messages.sent', [
            'messages' => Message::where('sender_id', auth()->id())->get()
        ]);
    }
}
