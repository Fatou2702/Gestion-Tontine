<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tontine extends Model
{
    use HasFactory;
     protected $fillable = [
        'nom',
        'montant',
        'frequence',
        'date_debut',
        'date_fin',
        'methode_attribution',
    ];
     // app/Models/Tontine.php

   
    public function users()
    {
        // Ici pareil : si la table pivot n'a pas de champ 'statut', on ne met pas withPivot('statut')
       return $this->belongsToMany(User::class)
                ->where('role', 'user');
    }














}

