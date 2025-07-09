<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTontineController extends Controller
{
    

    public function index()
{
    $user = Auth::user();

    // Tontines auxquelles l'utilisateur participe
     $query = Tontine::query();
    $tontines = $query;

    // Tontines qu'il peut encore rejoindre
     $tontinesDisponibles = Tontine::all();
     
    // $tontinesDisponibles = \App\Models\Tontine::whereDoesntHave('users', function ($query) use ($user) {
    //     $query->where('user_id', $user->id);
    // })->get();

    return view('user.dashboard', [
        'tontines' => $query,
        'tontines' => $tontines,
    ]);

     
}

public function join(Request $request)
    {
        $request->validate([
            'tontine_id' => 'required|exists:tontines,id',
        ]);

        $user = Auth::user();

        // Ajouter dans la table pivot avec statut = en_attente
        $user->tontines()->attach($request->tontine_id, [
            'statut' => 'en_attente',
        ]);

       return back()->with('success', 'Votre demande d\'adhésion a bien été envoyée et sera traitée sous peu.');

    }

}