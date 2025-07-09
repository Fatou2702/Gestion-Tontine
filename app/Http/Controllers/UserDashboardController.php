<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Tontine;



class UserDashboardController extends Controller
{
    public function index()
    {
         // 🔒 Vérification que c’est bien un USER
            if (Auth::user()->role !== 'user') {
                return redirect()->route('admin.dashboard'); // redirige un admin par erreur
            }
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Récupérer ses tontines
       // Je récupère SES tontines VALIDÉES par l’admin
        $tontines = $user->tontines()
                     ->wherePivot('statut', 'accepte')  // <- super important !
                     ->withCount('users')
                     ->get();

         $tontinesDisponibles = Tontine::all();
        // Récupérer les tontines disponibles (celles auxquelles il ne participe pas encore)
         
        return view('user.dashboard', compact('tontines', 'tontinesDisponibles'));
    }



}

