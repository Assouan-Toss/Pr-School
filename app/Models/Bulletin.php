<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    protected $fillable = [
        'eleve_id', 'semestre', 'file_path', 'publie_par', 'classe_id', 'moyenne'
    ];

    /** Relations */

    public function eleve()
    {
        return $this->belongsTo(User::class, 'eleve_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'publie_par');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }
}
