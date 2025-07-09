<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paiement;
use Carbon\Carbon;

class PaiementController extends Controller
{
    /**
     * Affiche la liste des paiements avec statut dynamique.
     */
    public function index()
    {
        // Récupérer tous les paiements + user + tontine
        $paiements = Paiement::with(['user', 'tontine'])->get();

        // Mettre à jour le statut *à l'affichage* sans modifier la BDD
        foreach ($paiements as $paiement) {
            if ($paiement->statut != 'paye') {
                if (Carbon::parse($paiement->date_prevue)->isPast()) {
                    $paiement->statut = 'en_retard';
                } else {
                    $paiement->statut = 'non_paye';
                }
            }
        }

        // Statistiques basées sur les statuts recalculés
        $stats = [
            'payes' => $paiements->where('statut', 'paye')->count(),
            'retard' => $paiements->where('statut', 'en_retard')->count(),
            'non_payes' => $paiements->where('statut', 'non_paye')->count(),
        ];

        return view('admin.payements.index', compact('paiements', 'stats'));
    }

    /**
     * Marquer un paiement comme payé.
     */
    public function marquerCommePaye($id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->statut = 'paye';
        $paiement->save();

        return redirect()->route('admin.paiements.index')
            ->with('success', 'Le paiement a été marqué comme payé.');
    }

    /**
     * Met à jour tous les statuts en base (optionnel).
     * À utiliser si tu souhaites sauvegarder les changements.
     */
    public function rafraichirStatuts()
    {
        $paiements = Paiement::where('statut', '!=', 'paye')->get();

        foreach ($paiements as $paiement) {
            if (Carbon::parse($paiement->date_prevue)->isPast()) {
                $paiement->statut = 'en_retard';
            } else {
                $paiement->statut = 'non_paye';
            }
            $paiement->save();
        }

        return redirect()->route('admin.paiements.index')
            ->with('success', 'Tous les statuts ont été mis à jour.');
    }
}
