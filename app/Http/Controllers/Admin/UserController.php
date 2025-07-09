<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tontine;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $nombreTontines = Tontine::count();

        // On récupère uniquement les utilisateurs avec role = user
        $users = User::where('role', 'user')->paginate(10);

        $nombreUsers = User::where('role', 'user')->count(); // 👈 pour éviter de compter les admins

        return view('admin.users.index', compact('users', 'nombreTontines', 'nombreUsers'));
    }
}
