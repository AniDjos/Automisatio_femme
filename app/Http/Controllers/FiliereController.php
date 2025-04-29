<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Importer Auth pour récupérer l'utilisateur connecté
use App\Models\Filiere; // Assurez-vous d'importer le modèle Filiere

class FiliereController extends Controller
{
    public function create()
    {
                // Récupérer l'utilisateur connecté
                $user = Auth::user();
    
                // Vérifier le rôle de l'utilisateur
                if ($user->role !== 'admin' && $user->role !== 'gestionnaire') {
                    return redirect()->route('login')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
                }
        return view('filiere.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'filiere_nom' => 'required|string|max:100',
        ]);

        // Création de la filière
        DB::table('filiere')->insert([
            'filiere_nom' => $request->input('filiere_nom'),
        ]);

        // Redirection avec un message de succès
        return redirect()->route('filiere.create')->with('success', 'Filière créée avec succès.');
    }

  
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Vérifier le rôle de l'utilisateur
        if ($user->role !== 'admin' && $user->role !== 'gestionnaire') {
            return redirect()->route('login')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
        }
    
        // Récupérer les filières avec pagination
        $filieres = DB::table('filiere')->orderBy('filiere_id', 'desc')->paginate(7);
    
        // Retourner la vue avec les filières
        return view('filieres.index', compact('filieres'));
    }

    public function edit($id)
    {
        // Récupérer la filière par son ID
        $filiere = DB::table('filiere')->where('filiere_id', $id)->first();

        // Vérifier si la filière existe
        if (!$filiere) {
            return redirect()->route('filiere.index')->with('error', 'Filière introuvable.');
        }

        // Retourner la vue d'édition
        return view('filieres.edit', compact('filiere'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'filiere_nom' => 'required|string|max:100',
        ]);

        // Mise à jour de la filière
        DB::table('filiere')->where('filiere_id', $id)->update([
            'filiere_nom' => $request->input('filiere_nom'),
        ]);

        // Redirection avec un message de succès
        return redirect()->route('filiere.index')->with('success', 'Filière mise à jour avec succès.');
    }
}