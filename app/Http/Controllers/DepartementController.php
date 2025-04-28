<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;

class DepartementController extends Controller
{
    public function create()
    {
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
        $departements = Departement::paginate(7); // Récupère les départements avec pagination
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
