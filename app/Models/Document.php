<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'titre', 'description', 'file_path', 'visible_pour',
        'publie_par', 'classe_id', 'matiere_id'
    ];

    /** Relations */

    public function auteur()
    {
        return $this->belongsTo(User::class, 'publie_par');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }
}
