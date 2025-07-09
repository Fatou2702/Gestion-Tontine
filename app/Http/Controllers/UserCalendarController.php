<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserCalendarController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // On récupère uniquement les tontines acceptées
        $tontines = $user->tontines()
            ->wherePivot('statut', 'accepte') // <-- AJOUT IMPORTANT
            ->get();

        $paiements = [];

        $mois = Carbon::now()->month;
        $annee = Carbon::now()->year;

        $startDate = Carbon::create($annee, $mois, 1)->startOfMonth();
        $endDate = Carbon::create($annee, $mois, 1)->endOfMonth();

        foreach ($tontines as $tontine) {

            // Si la date_paiement est vide, on prend la date de création de la tontine
            $currentDate = $tontine->date_paiement
                ? Carbon::parse($tontine->date_paiement)
                : Carbon::parse($tontine->created_at)->startOfDay();

            // Pour vérifier que c'est bien la date attendue
            // dd($currentDate);

            while ($currentDate <= $endDate) {

                if ($currentDate >= $startDate && $currentDate <= $endDate) {
                    if ($currentDate->format('Y-m-d') < Carbon::today()->format('Y-m-d')) {
                        $statut = 'retard';
                    } elseif ($currentDate->isToday()) {
                        $statut = 'aujourdhui';
                    } else {
                        $statut = 'a_venir';
                    }

                    $paiements[] = [
                        'date' => $currentDate->format('Y-m-d'),
                        'tontine_nom' => $tontine->nom,
                        'statut' => $statut,
                        'color' => $this->getTontineColor($tontine->id),
                    ];
                }

                // Avance la date selon la fréquence
                if ($tontine->frequence === 'mensuelle') {
                    $currentDate->addMonth();
                } elseif ($tontine->frequence === 'hebdomadaire') {
                    $currentDate->addWeek();
                } elseif ($tontine->frequence === 'bi-mensuelle') {
                    $currentDate->addWeeks(2);
                } else {
                    $currentDate->addMonth(); // par défaut
                }
            }
        }

        return view('user.calendar', [
            'paiements' => $paiements,
            'mois' => $mois,
            'annee' => $annee,
        ]);
    }

    private function getTontineColor($tontineId)
    {
        $colors = [
            '#e74c3c', // rouge
            '#3498db', // bleu
            '#2ecc71', // vert
            '#f1c40f', // jaune
            '#9b59b6', // violet
            '#1abc9c', // turquoise
        ];

        return $colors[$tontineId % count($colors)];
    }
}
