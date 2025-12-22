<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'file_path',
        'visible_pour',
        'publie_par',
        'classe_id',
        'matiere_id',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'publie_par');
    }
}
