<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quartier;
use App\Models\Arrondissement;
use App\Models\Commune;

class QuartierController extends Controller
{
    public function create()
    {
        $arrondissements = Arrondissement::all(); 
        return view('quartier.create', compact('arrondissements'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom_quartier' => 'required|string|max:255',
            'arrondissement_id' => 'required|integer|exists:arrondissement,arrondissement_id',
        ], [
            'nom_quartier.required' => 'Le nom du quartier est obligatoire.',
            'arrondissement_id.required' => 'L\'arrondissement est obligatoire.',
            'arrondissement_id.exists' => 'L\'arrondissement sélectionné est invalide.',
        ]);

        // Création du quartier
        Quartier::create([
            'quartier_libelle' => $validatedData['nom_quartier'],
            'arrondissement_id' => $validatedData['arrondissement_id'],
        ]);

        // Redirection avec un message de succès
        return redirect()->route('quartier.index')->with('success', 'Quartier créé avec succès.');
    }

    public function index()
    {
        $quartiers = Quartier::with(['arrondissement.commune'])->paginate(7); // Charge les relations pour arrondissement et commune
        return view('quartier.index', compact('quartiers'));
    }

    public function getArrondissements(Request $request)
    {
        // Récupérer les arrondissements associés à la commune sélectionnée
        $arrondissements = Arrondissement::where('commune_id', $request->commune_id)->get();

        // Retourner les données en JSON
        return response()->json($arrondissements);
    }

    public function getQuartiers(Request $request)
    {
        // Récupérer les quartiers associés à l'arrondissement sélectionné
        $quartiers = Quartier::where('arrondissement_id', $request->arrondissement_id)->get();

        // Retourner les données en JSON
        return response()->json($quartiers);
    }

    public function destroy($id)
    {
        // Récupérer le quartier par son ID
        $quartier = Quartier::findOrFail($id);

        // Supprimer le quartier
        $quartier->delete();

        // Redirection avec un message de succès
        return redirect()->route('quartier.index')->with('success', 'Quartier supprimé avec succès.');
    }

    public function edit($id)
    {
        $quartier = Quartier::findOrFail($id); // Récupérer le quartier par son ID
        $arrondissements = Arrondissement::all(); // Récupérer tous les arrondissements
        return view('quartier.edit', compact('quartier', 'arrondissements'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom_quartier' => 'required|string|max:255',
            'arrondissement_id' => 'required|integer|exists:arrondissement,arrondissement_id',
        ], [
            'nom_quartier.required' => 'Le nom du quartier est obligatoire.',
            'arrondissement_id.required' => 'L\'arrondissement est obligatoire.',
            'arrondissement_id.exists' => 'L\'arrondissement sélectionné est invalide.',
        ]);

        // Mise à jour du quartier
        $quartier = Quartier::findOrFail($id);
        $quartier->update([
            'quartier_libelle' => $validatedData['nom_quartier'],
            'arrondissement_id' => $validatedData['arrondissement_id'],
        ]);

        // Redirection avec un message de succès
        return redirect()->route('quartier.index')->with('success', 'Quartier mis à jour avec succès.');
    }
}
