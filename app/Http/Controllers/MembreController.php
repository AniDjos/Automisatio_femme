<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupement;
use App\Models\Membre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Importer Auth pour récupérer l'utilisateur connecté
use App\Models\User;

class MembreController extends Controller
{
    public function create()
    {
                        // Récupérer l'utilisateur connecté
                        $user = Auth::user();
    
                        // Vérifier le rôle de l'utilisateur
                        if ($user->role !== 'admin' && $user->role !== 'gestionnaire') {
                            return redirect()->route('login')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
                        }
        // Récupère tous les groupements pour les afficher dans le formulaire
        $groupements = Groupement::all();

        // Retourne la vue avec les données nécessaires
        return view('membres.create', compact('groupements'));
    }


    public function index(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Vérifier le rôle de l'utilisateur
        if ($user->role !== 'admin' && $user->role !== 'gestionnaire') {
            return redirect()->route('login')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
        }
    
        // Récupérer les filtres
        $search = $request->input('search');
        $groupementId = $request->input('groupement_id');
        $role = $request->input('role');
    
        // Construire la requête
        $query = DB::table('membre')
            ->leftJoin('groupement', 'membre.groupement_id', '=', 'groupement.groupement_id')
            ->select('membre.*', 'groupement.nom as groupement_nom');
            
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('membre.nom_membre', 'like', "%$search%")
                  ->orWhere('membre.prenom_membre', 'like', "%$search%");
            });
        }
    
        if ($groupementId) {
            $query->where('membre.groupement_id', $groupementId);
        }
    
        if ($role) {
            $query->where('membre.role_stimule', $role);
        }
    
        // Récupérer les membres avec pagination
        $membres = $query->orderBy('membre_id', 'desc')->paginate(7);
    
        // Récupérer les groupements pour le filtre
        $groupements = DB::table('groupement')->select('groupement_id', 'nom as groupement_nom')->get();
    
        // Récupérer les rôles distincts pour le filtre
        $roles = DB::table('membre')->select('role_stimule')->distinct()->pluck('role_stimule');
    
        // Retourner la vue avec les membres
        return view('membres.index', compact('membres', 'groupements', 'roles'));
    }
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom_membre' => 'required|string|max:255',
            'prenom_membre' => 'required|string|max:255',
            'role_stimule' => 'required|string|in:Présidente,Secrétaire,Membre,Trésorière',
            'telephone' => 'required|string|max:20|unique:membre,telephone',
            'groupement_id' => 'required|integer|exists:groupement,groupement_id',
        ], [
            'nom_membre.required' => 'Le nom du membre est obligatoire.',
            'prenom_membre.required' => 'Le prénom du membre est obligatoire.',
            'role_stimule.required' => 'Le rôle est obligatoire.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'telephone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'groupement_id.required' => 'Le groupement est obligatoire.',
            'groupement_id.exists' => 'Le groupement sélectionné est invalide.',
        ]);

        try {
            // Création du membre
            Membre::create([
                'nom_membre' => $validatedData['nom_membre'],
                'prenom_membre' => $validatedData['prenom_membre'],
                'role_stimule' => $validatedData['role_stimule'],
                'telephone' => $validatedData['telephone'],
                'groupement_id' => $validatedData['groupement_id'],
            ]);

            // Redirection avec un message de succès
            return redirect()->route('membres.index')->with('success', 'Membre ajouté avec succès.');
        } catch (\Exception $e) {
            // Gestion des erreurs
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création du membre : ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $membre = DB::table('membre')->where('membre_id', $id)->first();

        if (!$membre) {
            return redirect()->back()->with('error', 'Membre non trouvé.');
        }

        return view('membres.edit', compact('membre'));
    }

    public function update(Request $request, $id)
    {
        // Valider les données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
        ]);

        // Récupérer l'ID du groupement associé au membre
        $membre = DB::table('membre')->where('membre_id', $id)->first();

        if (!$membre) {
            return redirect()->back()->with('error', 'Membre non trouvé.');
        }

        // Mettre à jour le membre
        DB::table('membre')->where('membre_id', $id)->update([
            'nom_membre' => $validatedData['nom'],
            'prenom_membre' => $validatedData['prenom'],
            'role_stimule' => $validatedData['role'],
            'telephone' => $validatedData['telephone'],
            'updated_at' => now(),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('membres.index', $membre->groupement_id)->with('success', 'Membre mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $membre = DB::table('membre')->where('membre_id', $id)->first();

        if (!$membre) {
            return redirect()->back()->with('error', 'Membre non trouvé.');
        }

        DB::table('membre')->where('membre_id', $id)->delete();

        return redirect()->back()->with('success', 'Membre supprimé avec succès.');
    }

    public function show($id)
    {
        $membre = Membre::with('groupement')->findOrFail($id);

        
        return view('membres.show', compact('membre'));
    }
}
