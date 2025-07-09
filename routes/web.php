<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\TontineController;
use App\Http\Controllers\UserTontineController;
use App\Http\Controllers\UserCalendarController;
use App\Http\Controllers\UserPaymentHistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// pur la connecxion 
Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

 
// Admin (protégé par le middleware 'admin')

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});


// Pour la deconnection 
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
 
// admin :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

//pour les tontine 
Route::get('/tontines', [TontineController::class, 'index'])->name('tontines.index');
Route::post('/tontines', [TontineController::class, 'store'])->name('tontines.store');
Route::get('/tontines/{id}', [\App\Http\Controllers\TontineController::class, 'show'])->name('tontines.show');


//formulaire creation tontine 
Route::get('/tontines/create', [TontineController::class, 'create'])->name('tontines.create');
Route::post('/tontines', [TontineController::class, 'store'])->name('tontines.store');

// Pour voir la liste des user inscrit sur app 
 Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');

//  Pour la validation 
// Routes pour la validation des membres

Route::prefix('admin/validation-membres')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\ValidationMembreController::class, 'index'])->name('admin.validation_membres.index');
    Route::put('/valider/{id}', [App\Http\Controllers\Admin\ValidationMembreController::class, 'valider'])->name('admin.validation_membres.valider');
    Route::put('/refuser/{id}', [App\Http\Controllers\Admin\ValidationMembreController::class, 'refuser'])->name('admin.validation_membres.refuser');
});

//pour les paiement 
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/paiements', [\App\Http\Controllers\Admin\PaiementController::class, 'index'])->name('paiements.index');
    Route::put('/paiements/{id}/marquer-paye', [\App\Http\Controllers\Admin\PaiementController::class, 'marquerCommePaye'])->name('paiements.marquerPaye');
});


// pour user ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

// Utilisateur dasbord
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

// pour rejoindre une tontine 
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/tontines', [UserTontineController::class, 'index'])->name('tontines.index');
    Route::post('/tontines/join', [UserTontineController::class, 'join'])->name('tontines.join');
});

//pour l'affichage du clandrier 

Route::middleware(['auth'])->group(function () {
    Route::get('/user/calendar', [UserCalendarController::class, 'index'])->name('user.calendar');
});
// Route pour l'historique des payement 
Route::get('/user/payment-history', [UserPaymentHistoryController::class, 'index'])->name('user.payment.history');

 // Page formulaire de paiement
Route::get('/paiement/{tontine}', [\App\Http\Controllers\User\PaiementController::class, 'form'])
    ->middleware('auth')
    ->name('paiement.form');

// Soumission du paiement
Route::post('/paiement/{tontine}', [\App\Http\Controllers\User\PaiementController::class, 'valider'])
    ->middleware('auth')
    ->name('paiement.valider');
    
