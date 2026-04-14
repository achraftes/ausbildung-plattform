<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    protected $table = 'advices';
    
    protected $fillable = [
        'titre',
        'categorie',
        'contenu',
        'image',
        'temps_lecture',
        'is_top',
    ];
}
