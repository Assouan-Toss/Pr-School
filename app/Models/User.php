<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'classe_id', 'is_suspended'
    ];

    protected $hidden = [
        'password',
    ];

    /** Relations */

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function documentsPublies()
    {
        return $this->hasMany(Document::class, 'publie_par');
    }

    public function bulletins()
    {
        return $this->hasMany(Bulletin::class, 'eleve_id');
    }

    public function messagesEnvoyes()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function messagesRecus()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function matieresEnseignees()
    {
        return $this->hasMany(Matiere::class, 'professeur_id');
    }
}
