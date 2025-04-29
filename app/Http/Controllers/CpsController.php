<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cps;
use App\Models\Departement;
use App\Models\Commune;
use App\Models\Arrondissement;
use App\Models\Quartier;
use Illuminate\Support\Facades\Auth; // Importer Auth pour récupérer l'utilisateur connecté

class CpsController extends Controller
{


    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Vérifier le rôle de l'utilisateur
        if ($user->role === 'admin' || $user->role === 'gestionnaire') {
            // Si l'utilisateur est admin ou gestionnaire, récupérer tous les CPS
            $cps = Cps::orderBy('cps_id', 'desc')->paginate(7);
        } else {
            // Sinon, récupérer uniquement les CPS liés à l'utilisateur connecté
            $cps = Cps::where('users_id', $user->id)
                ->orderBy('cps_id', 'desc')
                ->paginate(7);
        }
    
        // Retourner la vue avec les CPS
        return view('cps.index', compact('cps'));
    }

    public function create()
    {
        // Récupérer tous les départements
        $departements = Departement::all();

        // Retourner la vue avec les départements
        return view('cps.create', compact('departements'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'cps_libelle' => 'required|string|max:255',
            'departement' => 'required|integer|exists:departement,departement_id',
            'commune' => 'required|integer|exists:commune,commune_id',
            'arrondissement' => 'required|integer|exists:arrondissement,arrondissement_id',
            'quartier' => 'required|integer|exists:quartier,quartier_id',   
        ], [
            'cps_libelle.required' => 'Le libellé du CPS est obligatoire.',
            'cps_libelle.max' => 'Le libellé du CPS ne doit pas dépasser 255 caractères.',
            'departement.required' => 'Le département est obligatoire.',
            'departement.exists' => 'Le département sélectionné est invalide.',
            'commune.required' => 'La commune est obligatoire.',
            'commune.exists' => 'La commune sélectionnée est invalide.',
            'arrondissement.required' => 'L\'arrondissement est obligatoire.',
            'arrondissement.exists' => 'L\'arrondissement sélectionné est invalide.',
            'quartier.required' => 'Le quartier est obligatoire.',
            'quartier.exists' => 'Le quartier sélectionné est invalide.',
        ]);

        // Création du CPS avec l'ID de l'utilisateur connecté
        Cps::create([
            'cps_libelle' => $validatedData['cps_libelle'],
            'departement_id' => $validatedData['departement'],
            'commune_id' => $validatedData['commune'],
            'arrondissement_id' => $validatedData['arrondissement'],
            'quartier_id' => $validatedData['quartier'],
            'users_id' => Auth::id(), 
        ]);

        // Redirection avec un message de succès
        return redirect()->route('cps.index')->with('success', 'CPS créé avec succès.');
    }
   

    public function edit($id)
    {
        try {
            $cps = Cps::findOrFail($id);
            $departements = Departement::all();
            $communes = Commune::where('departement_id', $cps->departement_id)->get();
            $arrondissements = Arrondissement::where('commune_id', $cps->commune_id)->get();
            $quartiers = Quartier::where('arrondissement_id', $cps->arrondissement_id)->get();

            return view('cps.edit', compact('cps', 'departements', 'communes', 'arrondissements', 'quartiers'));
        } catch (\Exception $e) {
            return redirect()->route('cps.index')->with('error', 'Erreur lors du chargement du CPS : ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'cps_libelle' => 'required|string|max:255',
            'departement' => 'required|integer|exists:departement,departement_id',
            'commune' => 'required|integer|exists:commune,commune_id',
            'arrondissement' => 'required|integer|exists:arrondissement,arrondissement_id',
            'quartier' => 'required|integer|exists:quartier,quartier_id',
        ], [
            'cps_libelle.required' => 'Le libellé du CPS est obligatoire.',
            'cps_libelle.max' => 'Le libellé du CPS ne doit pas dépasser 255 caractères.',
            'departement.required' => 'Le département est obligatoire.',
            'departement.exists' => 'Le département sélectionné est invalide.',
            'commune.required' => 'La commune est obligatoire.',
            'commune.exists' => 'La commune sélectionnée est invalide.',
            'arrondissement.required' => 'L\'arrondissement est obligatoire.',
            'arrondissement.exists' => 'L\'arrondissement sélectionné est invalide.',
            'quartier.required' => 'Le quartier est obligatoire.',
            'quartier.exists' => 'Le quartier sélectionné est invalide.',
        ]);

        try {
            // Mise à jour du CPS
            $cps = Cps::findOrFail($id);
            $cps->update([
                'cps_libelle' => $validatedData['cps_libelle'],
                'departement_id' => $validatedData['departement'],
                'commune_id' => $validatedData['commune'],
                'arrondissement_id' => $validatedData['arrondissement'],
                'quartier_id' => $validatedData['quartier'],
            ]);

            // Redirection avec un message de succès
            return redirect()->route('cps.index')->with('success', 'CPS modifié avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la modification du CPS : ' . $e->getMessage());
        }
    }



    public function destroy($id)
    {
        try {
            // Récupérer le CPS par son ID
            $cps = Cps::findOrFail($id);

            // Supprimer le CPS
            $cps->delete();

            // Redirection avec un message de succès
            return redirect()->route('cps.index')->with('success', 'CPS supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('cps.index')->with('error', 'Erreur lors de la suppression du CPS : ' . $e->getMessage());
        }
    }
}
