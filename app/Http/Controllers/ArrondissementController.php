<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commune;
use App\Models\Arrondissement;

class ArrondissementController extends Controller
{
    public function create()
    {
        $communes = Commune::all(); // Récupère toutes les communes
        return view('arrondissements.create', compact('communes'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'arrondissement_libelle' => 'required|string|max:255',
            'commune_id' => 'required|exists:commune,commune_id',
        ]);

        // Création de l'arrondissement
        Arrondissement::create($request->all());

        // Redirection avec un message de succès
        return redirect()->route('arrondissements.index')->with('success', 'Arrondissement enregistré avec succès.');
    }
    
    public function index()
    {
        $arrondissements = Arrondissement::with('commune')->paginate(7); // Récupère les arrondissements avec leur commune
        return view('arrondissements.index', compact('arrondissements'));
    }

    public function edit($id)
    {
        // Récupérer l'arrondissement par son ID
        $arrondissement = Arrondissement::findOrFail($id);

        // Récupérer toutes les communes
        $communes = Commune::all();

        // Retourner la vue d'édition
        return view('arrondissements.edit', compact('arrondissement', 'communes'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'arrondissement_libelle' => 'required|string|max:255',
            'commune_id' => 'required|exists:commune,commune_id',
        ]);

        // Récupérer l'arrondissement à modifier
        $arrondissement = Arrondissement::findOrFail($id);

        // Mise à jour des données
        $arrondissement->update($request->all());

        // Redirection avec un message de succès
        return redirect()->route('arrondissements.index')->with('success', 'Arrondissement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Récupérer l'arrondissement par son ID
        $arrondissement = Arrondissement::findOrFail($id);

        // Supprimer l'arrondissement
        $arrondissement->delete();

        // Redirection avec un message de succès
        return redirect()->route('arrondissements.index')->with('success', 'Arrondissement supprimé avec succès.');
    }
}
