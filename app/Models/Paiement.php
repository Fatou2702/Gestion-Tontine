<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
public function user()
{
    return $this->belongsTo(User::class);
}

public function tontine()
{
    return $this->belongsTo(Tontine::class);
}
protected $fillable = [
    'user_id',
    'tontine_id',
    'montant',
    'date_prevue',
    'statut',
];

}
