<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importer Auth pour récupérer l'utilisateur connecté
use App\Models\Departement;

class DepartementController extends Controller
{
    public function create()
    {
                        // Récupérer l'utilisateur connecté
                        $user = Auth::user();
    
                        // Vérifier le rôle de l'utilisateur
                        if ($user->role !== 'admin' && $user->role !== 'gestionnaire') {
                            return redirect()->route('login')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
                        }
        return view('departements.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'departement_libelle' => 'required|string|max:255',
        ]);

        // Création du département
        Departement::create($request->all());

        // Redirection avec un message de succès
        return redirect()->route('departements.index')->with('success', 'Département enregistré avec succès.');
    }


    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Vérifier le rôle de l'utilisateur
        if ($user->role !== 'admin' && $user->role !== 'gestionnaire') {
            return redirect()->route('login')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
        }
    
        // Récupérer les départements avec pagination
        $departements = Departement::orderBy('departement_id', 'desc')->paginate(7);
    
        // Retourner la vue avec les départements
        return view('departements.index', compact('departements'));
    }

    public function edit($id)
    {
        // Récupérer le département par son ID
        $departement = Departement::findOrFail($id);

        // Retourner la vue d'édition
        return view('departements.edit', compact('departement'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'departement_libelle' => 'required|string|max:255',
        ]);

        // Récupérer le département à modifier
        $departement = Departement::findOrFail($id);

        // Mise à jour des données
        $departement->update($request->all());

        // Redirection avec un message de succès
        return redirect()->route('departements.index')->with('success', 'Département mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Récupérer le département par son ID
        $departement = Departement::findOrFail($id);

        // Supprimer le département
        $departement->delete();

        // Redirection avec un message de succès
        return redirect()->route('departements.index')->with('success', 'Département supprimé avec succès.');
    }
}
