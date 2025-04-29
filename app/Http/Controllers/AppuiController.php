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
                        // Récupérer l'utilisateur connecté
                        $user = Auth::user();
    
                        // Vérifier le rôle de l'utilisateur
                        if ($user->role !== 'admin' && $user->role !== 'gestionnaire') {
                            return redirect()->route('login')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
                        }
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
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Vérifier le rôle de l'utilisateur
        if ($user->role === 'admin' || $user->role === 'gestionnaire') {
            // Si l'utilisateur est admin ou gestionnaire, récupérer tous les appuis
            $groupements = Groupement::all();
            $appuis = Appuis::with(['groupement', 'structure'])
                ->orderBy('appuis_id', 'desc')
                ->paginate(7);
        } else {
            // Sinon, afficher un message d'erreur ou rediriger
            return redirect()->route('login')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
        }
    
        // Retourner la vue avec les appuis
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
