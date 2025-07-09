<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    
   public function index()
        {
             // 🔒 Vérification que c’est bien un ADMIN
            if (auth()->user()->role !== 'admin') {
                return redirect()->route('user.dashboard'); // redirige un user par erreur
            }

            //recuperer le nombre de tontine 
            $nombreTontines = Tontine::count();
            
           //recupere le nombre de tontine en cour 
            $nombreTontinesEnCours = Tontine::where('date_fin', '>=', Carbon::today())->count();

            // Récupérer les demandes en attente
            $demandes = DB::table('tontine_user')
                ->join('users', 'tontine_user.user_id', '=', 'users.id')
                ->join('tontines', 'tontine_user.tontine_id', '=', 'tontines.id')
                ->where('tontine_user.statut', 'en_attente')
                ->select('tontine_user.id', 'users.name', 'tontines.nom', 'tontines.id as tontine_id', 'users.id as user_id')
                ->get();

            // Les autres données que tu passes déjà à la vue :
            $nombreTontines = \App\Models\Tontine::count();
            $nombreUsers = \App\Models\User::count();
            $tontinesEnCours = \App\Models\Tontine::where('date_fin', '>=', now())->count();

                return view('admin.admin_dasbord', compact('nombreTontines', 'nombreTontinesEnCours', 'demandes', 'nombreTontines', 'nombreUsers', 'tontinesEnCours'));
        }

    public function valider($id)
        {
            DB::table('tontine_user')
                ->where('id', $id)
                ->update(['statut' => 'accepte']);

            return back()->with('success', 'Demande acceptée.');
        }
}

