<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupementController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\QuartierController;
use App\Http\Controllers\CpsController;
use App\Http\Controllers\AgrementController;
use App\Http\Controllers\FiliereController;
use App\Http\Controller\EquipementController;
use App\Http\Controllers\AppuiController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\UtilisateurController;
use App\Models\Commune;
use App\Models\Arrondissement;
use App\Models\Quartier;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\AcceuilController::class,'Acceuil'])->name('App_acceuil');

Route::get('/contact', [\App\Http\Controllers\AcceuilController::class,'Contact'])->name('App_contact');

Route::get('/prestation', [\App\Http\Controllers\AcceuilController::class,'Prestation'])->name('App_prestation');

Route::get('/groupement', [\App\Http\Controllers\AcceuilController::class,'Groupement'])->name('App_groupement');

/**
 * * Routes pour la gestion de l'authentification
 */

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth') ;

Route::get('/Pre_dashboard', [DashboardController::class, 'pre'])->name('acceuilDashboard') ;

/**
 * * Routes pour la gestion des groupements
 * * Ces routes permettent de créer, afficher, modifier et supprimer des groupements.
 */
Route::get('/groupements', [GroupementController::class, 'index'])->name('groupements.index')->middleware('auth');

Route::get('/groupements/nouveau', [GroupementController::class, 'create'])->name('groupements.create')->middleware('auth');

Route::get('/groupements/{id}', [GroupementController::class, 'show'])->name('groupements.show');

Route::get('/groupements/{id}/edit', [GroupementController::class, 'edit'])->name('groupements.edit')->middleware('auth');

Route::post('/groupements', [GroupementController::class, 'store'])->name('groupements.store');

Route::delete('/groupements/{id}', [GroupementController::class, 'destroy'])->name('groupements.destroy');

Route::put('/groupements/{id}', [GroupementController::class, 'update'])->name('groupements.update');

Route::post('/get-communes', [GroupementController::class, 'getCommunes'])->name('get.communes');

Route::post('/get-arrondissements', [GroupementController::class, 'getArrondissements'])->name('get.arrondissements');

Route::post('/get-quartiers', [GroupementController::class, 'getQuartiers'])->name('get.quartiers');

Route::put('/groupements/{id}/toggle-status', [GroupementController::class, 'toggleStatus'])->name('groupements.toggleStatus');

/**
 * * Routes pour la gestion des membres
 * * Ces routes permettent de créer, afficher, modifier et supprimer des membres.
 */

Route::post('/membres', [MembreController::class, 'store'])->name('membres.store');

Route::get('/membres', [MembreController::class, 'index'])->name('membres.index')->middleware('auth');

Route::get('/membres/nouveau', [MembreController::class, 'create'])->name('membres.create')->middleware('auth');

Route::get('/membres/12647784238{id}63247/edit', [MembreController::class, 'edit'])->name('membres.edit');

Route::put('/membres/6527{id}6723', [MembreController::class, 'update'])->name('membres.update');

Route::delete('/membres/27643{id}63272', [MembreController::class, 'destroy'])->name('membres.destroy');

Route::get('/membres/{id}', [MembreController::class, 'show'])->name('membres.show');

/**
 * * Routes pour la gestion des appuis financiers
 * *
 */


 /**
  * * Routes pour la gestion des quartiers
  * * Ces routes permettent de créer, afficher, modifier et supprimer des quartiers.
  */
  
Route::post('/quartiers', [QuartierController::class, 'store'])->name('quartier.store');

Route::get('/quartiers/nouveau', [QuartierController::class, 'create'])->name('quartier.create')->middleware('auth');

Route::get('/quartiers', [QuartierController::class, 'index'])->name('quartier.index')->middleware('auth');

Route::get('/quartiers/{id}/edit', [QuartierController::class, 'edit'])->name('quartier.edit')->middleware('auth');

Route::put('/quartiers/{id}', [QuartierController::class, 'update'])->name('quartier.update');

Route::delete('/quartiers/{id}', [QuartierController::class, 'destroy'])->name('quartier.destroy');


/**
 * * Routes pour la gestion des CPS
 * * Ces routes permettent de créer, afficher, modifier et supprimer des CPS.
 */

Route::get('/cps', [CpsController::class, 'index'])->name('cps.index')->middleware('auth');

Route::get('/cps/nouveau', [CpsController::class, 'create'])->name('cps.create')->middleware('auth');

Route::get('/cps/{id}/edit', [CpsController::class, 'edit'])->name('cps.edit')->middleware('auth');

Route::put('/cps/{id}', [CpsController::class, 'update'])->name('cps.update');

Route::delete('/cps/{id}', [CpsController::class, 'destroy'])->name('cps.destroy');

Route::post('/cps', [CpsController::class, 'store'])->name('cps.store');

/**
 * * Routes pour la gestion des agréments
 */


Route::get('/agrementss', [AgrementController::class, 'index'])->name('agrement.index')->middleware('auth');

Route::get('/agrements/nouveau', [AgrementController::class, 'create'])->name('agrement.create')->middleware('auth');

Route::post('/agrementss', [AgrementController::class, 'store'])->name('agrement.store');

Route::get('/agrements/{id}/edit', [AgrementController::class, 'edit'])->name('agrement.edit')->middleware('auth');

Route::put('/agrements/{id}', [AgrementController::class, 'update'])->name('agrement.update');

Route::delete('/agrements/{id}', [AgrementController::class, 'destroy'])->name('agrement.destroy');

Route::get('/agrements/{id}', [App\Http\Controllers\AgrementController::class, 'show'])->name('agrement.show')->middleware('auth');

/**
 * * Routes pour la gestion des filieres
 * * Ces routes permettent de créer, afficher, modifier et supprimer des filières.
 */

Route::get('/filieres', [App\Http\Controllers\FiliereController::class, 'index'])->name('filiere.index')->middleware('auth');

Route::get('/filiere/create', [App\Http\Controllers\FiliereController::class, 'create'])->name('filiere.create')->middleware('auth');

Route::post('/filiere', [App\Http\Controllers\FiliereController::class, 'store'])->name('filiere.store');

Route::get('/filiere/{id}/edit', [App\Http\Controllers\FiliereController::class, 'edit'])->name('filiere.edit')->middleware('auth');

Route::put('/filiere/{id}', [App\Http\Controllers\FiliereController::class, 'update'])->name('filiere.update');

Route::delete('/filiere/{id}', [App\Http\Controllers\FiliereController::class, 'destroy'])->name('filiere.destroy');

/**
 * * Routes pour la gestion des équipements
 * * Ces routes permettent de créer, afficher, modifier et supprimer des équipements.
 */

 Route::get('/equipement/create', [App\Http\Controllers\EquipementController::class, 'create'])->name('equipement.create')->middleware('auth');
 
 Route::post('/equipement', [App\Http\Controllers\EquipementController::class, 'store'])->name('equipement.store');

 Route::get('/equipements', [App\Http\Controllers\EquipementController::class, 'index'])->name('equipement.index')->middleware('auth');

 Route::get('/equipements/{id}/edit', [App\Http\Controllers\EquipementController::class, 'edit'])->name('equipement.edit')->middleware('auth');

 Route::put('/equipement/{id}', [App\Http\Controllers\EquipementController::class, 'update'])->name('equipement.update');

 Route::delete('/equipement/{id}', [App\Http\Controllers\EquipementController::class, 'destroy'])->name('equipement.destroy');

 /**
  * * Routes pour la gestion des appuis
  * * Ces routes permettent de créer, afficher, modifier et supprimer des appuis.
  */

Route::get('/appuis/create', [App\Http\Controllers\AppuiController::class, 'create'])->name('appuis.create')->middleware('auth');

Route::post('/appuis', [App\Http\Controllers\AppuiController::class, 'store'])->name('appuis.store');

Route::get('/appuis', [App\Http\Controllers\AppuiController::class, 'index'])->name('appuis.index')->middleware('auth');

Route::get('/appuis/{id}/edit', [App\Http\Controllers\AppuiController::class, 'edit'])->name('appuis.edit')->middleware('auth');

Route::put('/appuis/{id}', [App\Http\Controllers\AppuiController::class, 'update'])->name('appuis.update');

Route::delete('/appuis/{id}', [App\Http\Controllers\AppuiController::class, 'destroy'])->name('appuis.destroy');


/**
 * * Routes pour la gestion des departements
 * * Ces routes permettent de créer, afficher, modifier et supprimer des departements.
 */

Route::get('/departements/create', [App\Http\Controllers\DepartementController::class, 'create'])->name('departements.create')->middleware('auth');

Route::post('/departements', [App\Http\Controllers\DepartementController::class, 'store'])->name('departements.store');

Route::get('/departements', [App\Http\Controllers\DepartementController::class, 'index'])->name('departements.index')->middleware('auth');

Route::get('/departements/{id}/edit', [App\Http\Controllers\DepartementController::class, 'edit'])->name('departements.edit')->middleware('auth');

Route::put('/departements/{id}', [App\Http\Controllers\DepartementController::class, 'update'])->name('departements.update');

Route::delete('/departements/{id}', [App\Http\Controllers\DepartementController::class, 'destroy'])->name('departements.destroy');

/**
 * Routes pour la gestion des communes
 */
Route::get('/communes/create', [App\Http\Controllers\CommuneController::class, 'create'])->name('communes.create')->middleware('auth');

Route::post('/communes', [App\Http\Controllers\CommuneController::class, 'store'])->name('communes.store');

Route::get('/communes', [App\Http\Controllers\CommuneController::class, 'index'])->name('communes.index')->middleware('auth');

Route::get('/communes/{id}/edit', [App\Http\Controllers\CommuneController::class, 'edit'])->name('communes.edit')->middleware('auth');

Route::put('/communes/{id}', [App\Http\Controllers\CommuneController::class, 'update'])->name('communes.update');

Route::delete('/communes/{id}', [App\Http\Controllers\CommuneController::class, 'destroy'])->name('communes.destroy');


/**
 * Routes pour la gestions des arrondissements 
 */
Route::get('/arrondissements/create', [App\Http\Controllers\ArrondissementController::class, 'create'])->name('arrondissements.create')->middleware('auth');

Route::post('/arrondissements', [App\Http\Controllers\ArrondissementController::class, 'store'])->name('arrondissements.store');

Route::get('/arrondissements', [App\Http\Controllers\ArrondissementController::class, 'index'])->name('arrondissements.index')->middleware('auth');

Route::get('/arrondissements/{id}/edit', [App\Http\Controllers\ArrondissementController::class, 'edit'])->name('arrondissements.edit')->middleware('auth');

Route::put('/arrondissements/{id}', [App\Http\Controllers\ArrondissementController::class, 'update'])->name('arrondissements.update');

Route::delete('/arrondissements/{id}', [App\Http\Controllers\ArrondissementController::class, 'destroy'])->name('arrondissements.destroy');

Route::get('/api/communes/{departement_id}', function ($departement_id) {
    return Commune::where('departement_id', $departement_id)->get();
});

Route::get('/api/arrondissements/{commune_id}', function ($commune_id) {
    return Arrondissement::where('commune_id', $commune_id)->get();
});

Route::get('/api/quartiers/{arrondissement_id}', function ($arrondissement_id) {
    return Quartier::where('arrondissement_id', $arrondissement_id)->get();
});

/**
 * Routes pour la gestion des utilisateurs
 */
Route::post('/utilisateurs', [\App\Http\Controllers\UtilisateurController::class, 'store'])->name('utilisateurs.store');

Route::get('/utilisateurs/nouveau', [\App\Http\Controllers\UtilisateurController::class, 'create'])->name('utilisateurs.create')->middleware('auth');

Route::get('/utilisateurs', [App\Http\Controllers\UtilisateurController::class, 'index'])->name('utilisateurs.index')->middleware('auth');

Route::put('/utilisateurs/{id}', [\App\Http\Controllers\UtilisateurController::class, 'update'])->name('utilisateurs.update');

Route::get('/utilisateurs/{id}/edit', [\App\Http\Controllers\UtilisateurController::class, 'edit'])->name('utilisateurs.edit')->middleware('auth');

Route::get('/utilisateurs/{id}', [\App\Http\Controllers\UtilisateurController::class, 'show'])->name('utilisateurs.show')->middleware('auth');

Route::delete('/utilisateurs/{id}', [\App\Http\Controllers\UtilisateurController::class, 'destroy'])->name('utilisateurs.destroy');

Route::put('/utilisateurs/{id}/toggle-status', [\App\Http\Controllers\UtilisateurController::class, 'toggleStatus'])->name('utilisateurs.toggleStatus');

// Route::get('/connexion', [\App\Http\Controllers\UtilisateurController::class, 'created'])->name('utilisateurs.login');

// Route::post('/login', [\App\Http\Controllers\UtilisateurController::class, 'authenticate'])->name('utilisateurs.authenticate');

Route::get('/logout',[\App\Http\Controllers\UtilisateurController::class, 'logout'])->name('logout');






