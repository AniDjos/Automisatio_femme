<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupement;
use App\Models\Structure;
use App\Models\Appuis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
        // Vérifier si l'utilisateur est connecté
        $user = Auth::user();

        // Validation des données
        $request->validate([
            'type_appuis' => 'required|string|max:255',
            'description' => 'required|string',
            'date_appuis' => 'required|date',
            'groupement_id' => 'required|exists:groupement,groupement_id',
            'structure_id' => 'required|exists:structure,structure_id',
        ]);

        // Ajouter l'identifiant de l'utilisateur connecté aux données
        $data = $request->all();
        $data['users_id'] = $user->id;

        // Créer l'appui
        Appuis::create($data);

        return redirect()->route('appuis.index')->with('success', 'Appui enregistré avec succès.');
    }

    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        $user = Auth::user();

        // Récupérer uniquement les appuis liés à cet utilisateur
        $appuis = Appuis::with(['groupement', 'structure'])
            ->where('users_id', $user->id)
            ->orderBy('appuis_id', 'desc')
            ->paginate(7);

        // Récupérer les groupements liés à cet utilisateur
        $groupements = Groupement::where('user_id', $user->id)->get();

        return view('appuis.index', compact('appuis', 'groupements'));
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
