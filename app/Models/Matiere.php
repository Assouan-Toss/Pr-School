<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $fillable = ['nom', 'professeur_id'];

    /** Relations */

    public function professeur()
    {
        return $this->belongsTo(User::class, 'professeur_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
