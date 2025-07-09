<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tontine;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaiementController extends Controller
{
    /**
     * Affiche le formulaire de paiement pour une tontine donnée.
     */
    public function form(Tontine $tontine)
    {
        $user = Auth::user();

        // Vérifie si l'utilisateur participe à cette tontine
        if (!$user->tontines->contains($tontine)) {
            abort(403, 'Accès interdit à cette tontine.');
        }

        return view('user.paiement_form', [
            'tontine' => $tontine,
            'montant' => $tontine->montant,
        ]);
    }

    /**
     * Valide le paiement simulé et enregistre en base de données.
     */
    public function valider(Request $request, Tontine $tontine)
    {
        $user = Auth::user();

        // Vérifie que l'utilisateur participe à cette tontine
        if (!$user->tontines->contains($tontine)) {
            abort(403, 'Accès interdit à cette tontine.');
        }

        // Vérifie qu'un opérateur a été envoyé dans le formulaire
        $request->validate([
            'operateur' => 'required|string',
        ]);

        // Enregistre le paiement dans la base
        Paiement::create([
            'user_id'     => $user->id,             // L'utilisateur connecté
            'tontine_id'  => $tontine->id,          // La tontine concernée
            'montant'     => $tontine->montant,     // Montant de la tontine
            'statut'      => 'paye',                // Statut (paye par défaut)
            'date_prevue' => now(),                 // Date du paiement
            'operateur'   => $request->operateur,   // L'opérateur choisi (Wave, Orange Money, etc.)
        ]);

        // Message flash pour indiquer le succès
        Session::flash('success', 'Votre paiement a bien été enregistré.');

        // Redirection vers le dashboard utilisateur
        return redirect()->route('user.dashboard');
    }
}
