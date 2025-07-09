<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserPaymentHistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tontines = $user->tontines()->get();

        $historique = [];

        foreach ($tontines as $tontine) {

            $startDate = $tontine->date_paiement
                ? Carbon::parse($tontine->date_paiement)
                : Carbon::now()->subMonths(6); // 💡 pour générer du passé

            $monTourReception = 3; // 💡 Simulation

            for ($tour = 1; $tour <= 8; $tour++) {

                $datePaiement = (clone $startDate)->addMonths($tour - 1);
                $now = Carbon::now()->startOfDay();

                if ($datePaiement->greaterThan($now)) {
                    continue; // ❌ on ignore le futur
                }

                // Réception ou paiement ?
                $type = ($tour === $monTourReception)
                    ? 'reception'
                    : 'paiement';

                // Statut :
                if ($type === 'reception') {
                    $statut = 'Reçu';
                } else {
                    // simulate : 50% payés, 50% en retard (exemple)
                    $statut = rand(0, 1) ? 'Payé' : 'En retard';
                }

                $historique[] = [
                    'date' => $datePaiement->format('Y-m-d'),
                    'tontine_nom' => $tontine->nom,
                    'montant' => $tontine->montant ?? 10000,
                    'statut' => $statut,
                    'tour' => $tour,
                    'type' => $type,
                ];
            }
        }

        // Tri par date descendante
        usort($historique, fn($a, $b) => strcmp($b['date'], $a['date']));

        return view('user.payment_history', [
            'historique' => $historique,
            'tontines' => $tontines,
        ]);
    }
}
