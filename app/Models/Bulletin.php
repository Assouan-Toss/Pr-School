<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    protected $fillable = [
        'eleve_id', 'semestre', 'file_path', 'publie_par'
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
}
