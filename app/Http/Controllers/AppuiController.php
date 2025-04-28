<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupement;
use App\Models\Structure;
use App\Models\Appuis;

class AppuiController extends Controller
{
    public function create()
    {
        $groupements = Groupement::all(); 
        $structures = Structure::all(); 
        return view('appuis.create', compact('groupements', 'structures'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'type_appuis' => 'required|string|max:255',
            'description' => 'required|string',
            'date_appuis' => 'required|date',
            'groupement_id' => 'required|exists:groupement,groupement_id',
            'structure_id' => 'required|exists:structure,structure_id',
        ]);

        Appuis::create($request->all());

        return redirect()->route('appuis.index')->with('success', 'Appui enregistré avec succès.');
    }

    public function index()
    {
        $appuis = Appuis::with(['groupement','structure'])->paginate(7); 
        return view('appuis.index', compact('appuis'));
    }

    public function edit($id)
    {
        // Récupérer l'appui par son ID
        $appui = Appuis::findOrFail($id);

        // Récupérer tous les groupements et structures
        $groupements = Groupement::all();
        $structures = Structure::all();

        // Retourner la vue d'édition
        return view('appuis.edit', compact('appui', 'groupements', 'structures'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'type_appuis' => 'required|string|max:255',
            'description' => 'required|string',
            'date_appuis' => 'required|date',
            'groupement_id' => 'required|exists:groupement,groupement_id',
            'structure_id' => 'required|exists:structure,structure_id',
        ]);

        // Récupérer l'appui à modifier
        $appui = Appuis::findOrFail($id);

        // Mise à jour des données
        $appui->update($request->all());

        // Redirection avec un message de succès
        return redirect()->route('appuis.index')->with('success', 'Appui mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Récupérer l'appui par son ID
        $appui = Appuis::findOrFail($id);

        // Supprimer l'appui
        $appui->delete();

        // Redirection avec un message de succès
        return redirect()->route('appuis.index')->with('success', 'Appui supprimé avec succès.');
    }
}
