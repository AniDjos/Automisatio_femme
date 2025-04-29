<?php

namespace App\Http\Controllers;
use App\Models\Appuis;
use App\Models\Groupement;
use App\Models\Departement;
use App\Models\Activite;
use App\Models\Agrement;
use App\Models\Equipement;
use App\Models\Filiere;
use App\Models\Commune;
use App\Models\Quartier;
use App\Models\Arrondissement;
use App\Models\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Importer Auth pour récupérer l'utilisateur connecté

class GroupementController extends Controller
{
    /**
     * Affiche la liste des groupements avec recherche et pagination.
     */
   
    public function index(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Vérifier le rôle de l'utilisateur
        if ($user->role !== 'admin' && $user->role !== 'gestionnaire') {
            return redirect()->route('login')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
        }
    
        $search = $request->input('search');
    
        // Construire la requête de recherche
        $query = DB::table('groupement')
            ->join('departement', 'groupement.departement_id', '=', 'departement.departement_id') 
            ->leftJoin('commune', 'commune.commune_id', '=', 'groupement.commune') 
            ->leftJoin('arrondissement', 'arrondissement.arrondissement_id', '=', 'groupement.arrondissement')
            ->leftJoin('quartier', 'quartier.quartier_id', '=', 'groupement.quartier')
            ->leftJoin('activite as activite_principale', 'activite_principale.activite_id', '=', 'groupement.activite_principale_id')
            ->leftJoin('activite as activite_secondaire', 'activite_secondaire.activite_id', '=', 'groupement.activite_secondaire_id') 
            ->select(
                'groupement.groupement_id',
                'groupement.nom as groupement_nom',
                'groupement.effectif',
                'groupement.statut',
                'groupement.date_creation',
                'departement.departement_libelle as departement_nom', 
                'commune.commune_libelle as commune_nom',
                'arrondissement.arrondissement_libelle as arrondissement_nom',
                'quartier.quartier_libelle as quartier_nom', 
                'activite_principale.activite as activite_principale_nom', 
                'activite_secondaire.activite as activite_secondaire_nom'
            );
    
        // Appliquer la recherche si un terme est fourni
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('groupement.nom', 'like', "%$search%")
                  ->orWhere('departement.departement_libelle', 'like', "%$search%")
                  ->orWhere('commune.commune_libelle', 'like', "%$search%")
                  ->orWhere('arrondissement.arrondissement_libelle', 'like', "%$search%")
                  ->orWhere('quartier.quartier_libelle', 'like', "%$search%")
                  ->orWhere('activite_principale.activite', 'like', "%$search%")
                  ->orWhere('activite_secondaire.activite', 'like', "%$search%")
                  ->orWhere('groupement.effectif', '=', $search)
                  ->orWhere('groupement.statut', '=', $search); 
            });
        }
    
        // Pagination des résultats
        $groupements = $query->orderBy('groupement_id', 'desc')->paginate(6);
    
        // Retourner la vue avec les données
        return view('groupements.index', compact('groupements'));
    }

    /**
     * Affiche le formulaire multi-étapes.
     */
    public function create()
    {
                        // Récupérer l'utilisateur connecté
                        $user = Auth::user();
    
                        // Vérifier le rôle de l'utilisateur
                        if ($user->role !== 'admin' && $user->role !== 'gestionnaire') {
                            return redirect()->route('login')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
                        }
        $departements = Departement::all();
        $activites = Activite::all();
        $filieres = Filiere::all();
        $structures = Structure::all();

        return view('groupements.create', compact('departements', 'activites', 'filieres', 'structures'));
    }

    /**
     * Enregistre les données du formulaire multi-étapes.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'effectif' => 'required|integer|min:1',
            'departement' => 'required|integer|exists:departement,departement_id',
            'commune' => 'required|integer|exists:commune,commune_id',
            'arrondissement' => 'required|integer|exists:arrondissement,arrondissement_id',
            'quartier' => 'required|integer|exists:quartier,quartier_id',
            'revenu' => 'required|numeric|min:0',
            'benefice' => 'required|numeric|min:0',
            'depense' => 'required|numeric|min:0',
            'activite_principale' => 'required|integer|exists:activite,activite_id',
            'activite_secondaire' => 'nullable|integer|exists:activite,activite_id',
            'filiere' => 'required|integer|exists:filiere,filiere_id',
            'date_creation' => 'required|date',
            
            // Appui (conditionnel)
            'type_appui' => 'required_if:appui,true|nullable|string|in:financier,materiel',
            'structure' => 'required_if:appui,true|nullable|integer|exists:structure,structure_id',
            'description_appui' => 'nullable|string',
            'annee_appui' => 'nullable|date',
            
            // Équipement & Agrément
            'equipement' => 'required|string|max:255',
            'etat_equipement' => 'required|string|in:neuf,use',
            'description_difficulte' => 'nullable|string',
            'description_besoin' => 'nullable|string',
            'structure_delivrance' => 'required|nullable|integer|exists:structure,structure_id',
            'reference' => 'required|string|max:255',
            'agrement' => 'file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'annee_delivrance' => 'required|date',
        ]);
    
        // Transaction pour garantir l'intégrité des données
        DB::beginTransaction();
    
        try {
            // Création du groupement
            $groupement = Groupement::create([
                'nom' => $validatedData['nom'],
                'effectif' => $validatedData['effectif'],
                'departement_id' => $validatedData['departement'],
                'commune' => $validatedData['commune'],
                'arrondissement' => $validatedData['arrondissement'],
                'quartier' => $validatedData['quartier'],
                'revenu_mens' => $validatedData['revenu'],
                'benefice_mens' => $validatedData['benefice'],
                'depense_mens' => $validatedData['depense'],
                'activite_principale_id' => $validatedData['activite_principale'],
                'activite_secondaire_id' => $validatedData['activite_secondaire'] ?? null,
                'filiere_id' => $validatedData['filiere'],
                'date_creation' => $validatedData['date_creation'],
                'statut' => False,
                'users_id' => Auth::id(), 

            ]);
    
            // Gestion de l'appui
            if ($request->boolean('appui')) {
                Appuis::create([
                    'groupement_id' => $groupement->groupement_id,
                    'type_appuis' => $validatedData['type_appui'],
                    'structure_id' => $validatedData['structure'],
                    'description' => $validatedData['description_appui'] ?? null,
                    'date_appuis' => $validatedData['annee_appui'] ?? null,
                    'users_id' => Auth::id(), 
                ]);
            }
    
            // Création de l'équipement
            Equipement::create([
                'groupement_id' => $groupement->groupement_id,
                'equipment_libelle' => $validatedData['equipement'],
                'stat_equipement' => $validatedData['etat_equipement'],
                'description_difficultie' => $validatedData['description_difficulte'] ?? null,
                'description_besoin' => $validatedData['description_besoin'] ?? null,
                'users_id' => Auth::id(), 
            ]);
    
            // Gestion du fichier
            if ($request->hasFile('agrement')) {
                $file = $request->file('agrement');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('agrements'), $filename);
            }
        
            // Création de l'agrément
            Agrement::create([
                'groupement_id' => $groupement->groupement_id,
                'structure' => $validatedData['structure_delivrance'],
                'reference' => $validatedData['reference'],
                'document' => $filename,
                'date_deliver' => $validatedData['annee_delivrance'],
                'users_id' => Auth::id(), 
            ]);
    
            DB::commit();
    
            return redirect()->route('groupements.index')
                ->with('success', 'Groupement créé avec succès.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Erreur lors de la création: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'effectif' => 'required|integer|min:1',
            'departement' => 'required|integer|exists:departement,departement_id',
            'commune' => 'required|integer|exists:commune,commune_id',
            'arrondissement' => 'required|integer|exists:arrondissement,arrondissement_id',
            'quartier' => 'required|integer|exists:quartier,quartier_id',
            'revenu' => 'required|numeric|min:0',
            'benefice' => 'required|numeric|min:0',
            'depense' => 'required|numeric|min:0',
            'activite_principale' => 'required|integer|exists:activite,activite_id',
            'activite_secondaire' => 'nullable|integer|exists:activite,activite_id',
            'filiere' => 'required|integer|exists:filiere,filiere_id',
            'date_creation' => 'required|date',
            
            // Appui (conditionnel)
            'type_appui' => 'required_if:appui,true|nullable|string|in:financier,materiel',
            'structure' => 'required_if:appui,true|nullable|integer|exists:structure,structure_id',
            'description_appui' => 'nullable|string',
            'annee_appui' => 'nullable|date',
            
            // Équipement & Agrément
            'equipement' => 'required|string|max:255',
            'etat_equipement' => 'required|string|in:neuf,use',
            'description_difficulte' => 'nullable|string',
            'description_besoin' => 'nullable|string',
            'structure_delivrance' => 'required|nullable|integer|exists:structure,structure_id',
            'reference' => 'required|string|max:255',
            'agrement' => 'file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'annee_delivrance' => 'required|date',
        ]);

        // Transaction pour garantir l'intégrité des données
        DB::beginTransaction();

        try {
            // Mise à jour du groupement
            $groupement = Groupement::findOrFail($id);
            $groupement->update([
                'nom' => $validatedData['nom'],
                'effectif' => $validatedData['effectif'],
                'departement_id' => $validatedData['departement'],
                'commune' => $validatedData['commune'],
                'arrondissement' => $validatedData['arrondissement'],
                'quartier' => $validatedData['quartier'],
                'revenu_mens' => $validatedData['revenu'],
                'benefice_mens' => $validatedData['benefice'],
                'depense_mens' => $validatedData['depense'],
                'activite_principale_id' => $validatedData['activite_principale'],
                'activite_secondaire_id' => $validatedData['activite_secondaire'] ?? null,
                'filiere_id' => $validatedData['filiere'],
                'date_creation' => $validatedData['date_creation'],
            ]);

            // Gestion de l'appui
            if ($request->boolean('appui')) {
                $appui = Appuis::where('groupement_id', $groupement->groupement_id)->first();
                if ($appui) {
                    $appui->update([
                        'type_appuis' => $validatedData['type_appui'],
                        'structure_id' => $validatedData['structure'],
                        'description' => $validatedData['description_appui'] ?? null,
                        'date_appuis' => $validatedData['annee_appui'] ?? null,
                    ]);
                } else {
                    Appuis::create([
                        'groupement_id' => $groupement->groupement_id,
                        'type_appuis' => $validatedData['type_appui'],
                        'structure_id' => $validatedData['structure'],
                        'description' => $validatedData['description_appui'] ?? null,
                        'date_appuis' => $validatedData['annee_appui'] ?? null,
                    ]);
                }
            }

            // Mise à jour de l'équipement
            $equipement = Equipement::where('groupement_id', $groupement->groupement_id)->first();
            if ($equipement) {
                $equipement->update([
                    'equipment_libelle' => $validatedData['equipement'],
                    'stat_equipement' => $validatedData['etat_equipement'],
                    'description_difficultie' => $validatedData['description_difficulte'] ?? null,
                    'description_besoin' => $validatedData['description_besoin'] ?? null,
                ]);
            } else {
                Equipement::create([
                    'groupement_id' => $groupement->groupement_id,
                    'equipment_libelle' => $validatedData['equipement'],
                    'stat_equipement' => $validatedData['etat_equipement'],
                    'description_difficultie' => $validatedData['description_difficulte'] ?? null,
                    'description_besoin' => $validatedData['description_besoin'] ?? null,
                ]);
            }

            // Gestion du fichier
            $filename = null;
            if ($request->hasFile('agrement')) {
                $file = $request->file('agrement');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('agrements'), $filename);
            }

            // Mise à jour de l'agrément
            $agrement = Agrement::where('groupement_id', $groupement->groupement_id)->first();
            if ($agrement) {
                $agrement->update([
                    'structure' => $validatedData['structure_delivrance'],
                    'reference' => $validatedData['reference'],
                    'document' => $filename ?? $agrement->document,
                    'date_deliver' => $validatedData['annee_delivrance'],
                ]);
            } else {
                Agrement::create([
                    'groupement_id' => $groupement->groupement_id,
                    'structure' => $validatedData['structure_delivrance'],
                    'reference' => $validatedData['reference'],
                    'document' => $filename,
                    'date_deliver' => $validatedData['annee_delivrance'],
                ]);
            }

            DB::commit();

            return redirect()->route('groupements.index')
                ->with('success', 'Groupement modifié avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Erreur lors de la modification: ' . $e->getMessage());
        }
    }

    /**
     * Récupère les communes associées à un département.
     */
    public function getCommunes(Request $request)
    {
        $communes = Commune::where('departement_id', $request->departement_id)->get();
        return response()->json($communes);
    }

    /**
     * Récupère les arrondissements associés à une commune.
     */
    public function getArrondissements(Request $request)
    {
        $arrondissements = Arrondissement::where('commune_id', $request->commune_id)->get();
        return response()->json($arrondissements);
    }

    /**
     * Récupère les quartiers associés à un arrondissement.
     */
    public function getQuartiers(Request $request)
    {
        $quartiers = Quartier::where('arrondissement_id', $request->arrondissement_id)->get();

        // Retourne les données au format JSON
        return response()->json($quartiers);
    }
    

    public function show($id)
    {
        // Construire la requête pour récupérer les détails du groupement
        $groupement = DB::table('groupement')
            ->join('departement', 'groupement.departement_id', '=', 'departement.departement_id') 
            ->leftJoin('commune', 'commune.commune_id', '=', 'groupement.commune') 
            ->leftJoin('arrondissement', 'arrondissement.arrondissement_id', '=', 'groupement.arrondissement') 
            ->leftJoin('quartier', 'quartier.quartier_id', '=', 'groupement.quartier') 
            ->leftJoin('activite as activite_principale', 'activite_principale.activite_id', '=', 'groupement.activite_principale_id') 
            ->leftJoin('activite as activite_secondaire', 'activite_secondaire.activite_id', '=', 'groupement.activite_secondaire_id')
            ->leftJoin('equipement', 'equipement.groupement_id', '=', 'groupement.groupement_id') 
            ->leftJoin('appuis', 'appuis.groupement_id', '=', 'groupement.groupement_id')
            ->leftJoin('filiere', 'filiere.filiere_id', '=', 'groupement.filiere_id')
            ->leftJoin('agrement', 'agrement.groupement_id', '=', 'groupement.groupement_id') 
            ->leftJoin('structure', 'agrement.structure', '=', 'structure.structure_id')
            ->select(
                'groupement.groupement_id',
                'groupement.nom as groupement_nom',
                'groupement.effectif',
                'groupement.statut',
                'filiere.filiere_nom',
                'groupement.revenu_mens',
                'groupement.benefice_mens',
                'groupement.depense_mens',
                'groupement.date_creation',
                'departement.departement_libelle as departement_nom', 
                'commune.commune_libelle as commune_nom', 
                'arrondissement.arrondissement_libelle as arrondissement_nom', 
                'quartier.quartier_libelle as quartier_nom', 
                'activite_principale.activite as activite_principale_nom', 
                'activite_secondaire.activite as activite_secondaire_nom',
                'equipement.equipment_libelle as equipement_nom', 
                'equipement.stat_equipement as equipement_etat', 
                'appuis.type_appuis as appui_type',
                'appuis.description as appui_description',
                'appuis.date_appuis as appui_annee', 
                'equipement.equipment_libelle as equipement',  
                'equipement.stat_equipement as etat_equipement' ,
                'equipement.description_difficultie as description_difficultie',
                'equipement.description_besoin as description_besoin',
                'appuis.date_appuis as appui_date', 
                'structure.structure',
                'agrement.reference as agrement_reference', 
                'agrement.date_deliver as agrement_date' 
            )
            ->where('groupement.groupement_id', '=', $id) 
            ->first(); 
    
        // Vérifier si le groupement existe
        if (!$groupement) {
            abort(404, 'Groupement non trouvé.');
        }
    
        // Retourner la vue avec les détails du groupement
        return view('groupements.show', compact('groupement'));
    }

    public function edit($id)
    {
        $groupement = Groupement::findOrFail($id);
        $departements = Departement::all();
        $communes = Commune::all();
        $arrondissements = Arrondissement::all();
        $quartiers = Quartier::all();
        $activites = Activite::all();
        $filieres = Filiere::all();
        $structures = Structure::all();
        $agrements = Agrement::all();
        $equipements = Equipement::all();
        $appuis = Appuis::all();

        return view('groupements.edit', compact('groupement','agrements' ,'departements', 'communes', 'arrondissements', 'quartiers', 'activites', 'filieres','structures', 'equipements', 'appuis'));
    }

    public function toggleStatus($id)
    {
        // Récupérer l'utilisateur
        $groupement = DB::table('groupement')->where('groupement_id', $id)->first();

        if (!$groupement) {
            return redirect()->route('groupements.index')->with('error', 'Groupement introuvable.');
        }

        // Basculer le statut
        $nouveauStatut = !$groupement->statut;

        DB::table('groupement')->where('groupement_id', $id)->update([
            'statut' => $nouveauStatut,
            'updated_at' => now(),
        ]);

        // Message de succès
        $message = $nouveauStatut ? 'Groupement activé avec succès.' : 'Groupement désactivé avec succès.';
        return redirect()->route('groupements.index')->with('success', $message);
    }

    public function dashboard($id)
    {
        // Récupérer le groupement par son ID avec ses relations
        $groupement = Groupement::with(['localisation', 'agrement', 'activites', 'equipement', 'finances', 'appui'])
            ->findOrFail($id);

        // Retourner la vue avec les données du groupement
        return view('dashboardEntete.pageModerateur', compact('groupement'));
    }
}