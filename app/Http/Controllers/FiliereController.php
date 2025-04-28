<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiliereController extends Controller
{
    public function create()
    {
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
        $filieres = DB::table('filiere')->paginate(7); // Récupère les filières avec pagination
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
