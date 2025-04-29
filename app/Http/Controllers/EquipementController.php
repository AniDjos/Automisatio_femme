<?php

namespace App\Http\Controllers;
use App\Models\Groupement;
use App\Models\Equipement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Structure;
use App\Models\Appuis;

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

        // Création de l'équipement avec l'ID de l'utilisateur connecté
        Equipement::create([
            'equipment_libelle' => $request->input('equipment_libelle'),
            'stat_equipement' => $request->input('stat_equipement'),
            'description_difficultie' => $request->input('description_difficultie'),
            'description_besoin' => $request->input('description_besoin'),
            'groupement_id' => $request->input('groupement_id'),
            'users_id' => Auth::id(), // Ajouter l'ID de l'utilisateur connecté
        ]);

        // Redirection avec un message de succès
        return redirect()->route('equipement.create')->with('success', 'Équipement enregistré avec succès.');
    }

    public function index()
    {
        $equipements = Equipement::with('groupement')->orderBy('equipement_id','desc')->paginate(7); 
        $groupements = Groupement::all();
        return view('equipements.index', compact('equipements', 'groupements'));
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
