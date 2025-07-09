<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tontine;

class ValidationMembreController extends Controller
{
    // Lister les demandes de membres en attente (pivot statut = 'en_attente')
public function index()
    {
        $demandes = \DB::table('tontine_user')
            ->join('users', 'tontine_user.user_id', '=', 'users.id')
            ->join('tontines', 'tontine_user.tontine_id', '=', 'tontines.id')
            ->select('tontine_user.id as demande_id', 'users.name as nom_user', 'users.email', 'tontines.nom as nom_tontine', 'tontine_user.statut')
            ->where('tontine_user.statut', 'en_attente')
            ->get();

        //afficher le nombre de tontines 
        $nombreTontines = Tontine::count();

        //afficher le nombre de membre
        $nombreUsers = \App\Models\User::count();     
        return view('admin.validation_membres.index', compact('demandes', 'nombreTontines', 'nombreUsers'));
    }

    // Action : valider une demande
    public function valider($id)
    {
        \DB::table('tontine_user')
            ->where('id', $id)
            ->update(['statut' => 'accepte']);

        return back()->with('success', 'Le membre a été validé avec succès.');
    }
    // Action : refuser une demande

    public function refuser($id)
    {
        \DB::table('tontine_user')
            ->where('id', $id)
            ->update(['statut' => 'refuse']);

        return back()->with('success', 'La demande a été refusée.');
    }
}
