<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tontine;

class TontineController extends Controller
{
            public function index(Request $request)
        {
            $query = Tontine::query();

            // Filtres
            if ($request->filled('frequence')) {
                $query->where('frequence', $request->frequence);
            }

            if ($request->filled('date')) {
                $query->whereDate('date_debut', $request->date);
            }

            $tontines = $query->orderBy('date_debut')->paginate(4); // pagination

        // 👉 Nombre total de tontines
        $nombreTontines = Tontine::count();

        // 👉 Nombre de tontines en cours
        $tontinesEnCours = Tontine::whereDate('date_fin', '>', now())->count();

          //afficher le nombre de membre
        $nombreUsers = \App\Models\User::count();

        return view('tontines.index', compact('tontines', 'nombreTontines', 'tontinesEnCours', 'nombreUsers'));

                
        }
            

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'montant' => 'required|numeric',
            'frequence' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'methode_attribution' => 'required',
        ]);

        Tontine::create($request->all());

        return redirect()->route('tontines.index')->with('success', 'Tontine créée avec succès.');
    }


    // retourner le formulaire 
    public function create()
    {
        return view('tontines.create');
    }

    public function show()
    {
        return view('tontines.create');
    }

 
}
