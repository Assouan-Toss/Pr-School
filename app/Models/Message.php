<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'contenu', 'status'
    ];

    /** Relations */

    public function expediteur()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
