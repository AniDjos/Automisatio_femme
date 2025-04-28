<?php

namespace App\Http\Controllers;
use App\Models\Groupement;
use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    public function create()
    {
        $groupements = Groupement::all(); // Récupère tous les groupements
        return view('equipement.create', compact('groupements'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'equipment_libelle' => 'required|string|max:255',
            'stat_equipement' => 'required|string',
            'description_difficultie' => 'nullable|string',
            'description_besoin' => 'nullable|string',
            'groupement_id' => 'required|exists:groupement,groupement_id',
        ]);

        // Création de l'équipement
        Equipement::create($request->all());

        // Redirection avec un message de succès
        return redirect()->route('equipement.create')->with('success', 'Équipement enregistré avec succès.');
    }

    public function index()
    {
        $equipements = Equipement::with('groupement')->paginate(7); // Récupère les équipements avec leur groupement
        return view('equipements.index', compact('equipements'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'equipment_libelle' => 'required|string|max:255',
            'stat_equipement' => 'required|string',
            'description_difficultie' => 'nullable|string',
            'description_besoin' => 'nullable|string',
            'groupement_id' => 'required|exists:groupement,groupement_id',
        ]);

        // Récupération de l'équipement à modifier
        $equipement = Equipement::findOrFail($id);

        // Mise à jour des données
        $equipement->update($request->all());

        // Redirection avec un message de succès
        return redirect()->route('equipement.index')->with('success', 'Équipement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Récupération de l'équipement à supprimer
        $equipement = Equipement::findOrFail($id);

        // Suppression de l'équipement
        $equipement->delete();

        // Redirection avec un message de succès
        return redirect()->route('equipement.index')->with('success', 'Équipement supprimé avec succès.');
    }

    public function edit($id)
    {
        // Récupérer l'équipement par son ID
        $equipement = Equipement::findOrFail($id);

        // Récupérer tous les groupements
        $groupements = Groupement::all();

        // Retourner la vue d'édition
        return view('equipements.edit', compact('equipement', 'groupements'));
    }
}
