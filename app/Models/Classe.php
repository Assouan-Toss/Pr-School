<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = ['nom', 'niveau'];

    /** Relations */

    public function eleves()
    {
        return $this->hasMany(User::class)->where('role', 'eleve');
    }

    public function professeurs()
    {
        return $this->hasMany(User::class)->where('role', 'professeur');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
