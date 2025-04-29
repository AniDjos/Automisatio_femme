<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class UtilisateurController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:users,email',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
            'statut' => false, 
        ]);


        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur créé avec succès.');
    }


    public function index(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Vérifier le rôle de l'utilisateur
        if ($user->role !== 'admin' && $user->role !== 'gestionnaire') {
            return redirect()->route('dashboard')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
        }
    
        $query = User::query();
    
        // Filtrer par statut
        if ($request->has('filter')) {
            if ($request->filter === 'activé') {
                $query->where('statut', true);
            } elseif ($request->filter === 'désactivé') {
                $query->where('statut', false);
            }
        }
    
        // Filtrer par rôle
        if ($request->has('role')) {
            $query->where('role', $request->role);
        }
    
        // Recherche par nom ou prénom
        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.nom', 'like', "%$search%")
                  ->orWhere('users.prenom', 'like', "%$search%");
            });
        }
    
        // Trier les résultats dans l'ordre décroissant par ID
        $query->orderBy('id', 'desc');
    
        // Pagination
        $utilisateurs = $query->paginate(6);
    
        // Retourner la vue avec les utilisateurs
        return view('utilisateurs.index', compact('utilisateurs'));
    }

    public function create()
    {
                        // Récupérer l'utilisateur connecté
                        $user = Auth::user();
    
                        // Vérifier le rôle de l'utilisateur
                        if ($user->role !== 'admin' && $user->role !== 'gestionnaire') {
                            return redirect()->route('login')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
                        }
        return view('utilisateurs.create');
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:users,email,' . $id . ',id',
            'role' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'statut' => 'required|boolean',
        ]);

        // Vérification de l'utilisateur connecté
        if (!Auth::user()->can('update', User::class)) {
            return redirect()->route('utilisateurs.index')->with('error', 'Action non autorisée.');
        }

        // Mise à jour de l'utilisateur
        DB::table('users')->where('id', $id)->update([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => $validatedData['password'] ? Hash::make($validatedData['password']) : DB::raw('password'),
            'statut' => $validatedData['statut'],
            'updated_at' => now(),
        ]);

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        // Vérification de l'utilisateur connecté
        if (!Auth::user()->can('delete', User::class)) {
            return redirect()->route('utilisateurs.index')->with('error', 'Action non autorisée.');
        }

        // Supprimer l'utilisateur par son ID
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function show($id)
    {
        // Récupérer l'utilisateur par son ID
        $utilisateur = DB::table('users')->where('id', $id)->first();

        // Vérifier si l'utilisateur existe
        if (!$utilisateur) {
            return redirect()->route('utilisateurs.index')->with('error', 'Utilisateur introuvable.');
        }

        // Retourner la vue avec les détails de l'utilisateur
        return view('utilisateurs.show', compact('utilisateur'));
    }

    public function edit($id)
    {
        // Récupérer l'utilisateur par son ID
        $utilisateur = DB::table('users')->where('id', $id)->first();

        // Vérifier si l'utilisateur existe
        if (!$utilisateur) {
            return redirect()->route('utilisateurs.index')->with('error', 'Utilisateur introuvable.');
        }

        // Retourner la vue de modification avec les données de l'utilisateur
        return view('utilisateurs.edit', compact('utilisateur'));
    }

    public function toggleStatus($id)
    {
        // Vérification de l'utilisateur connecté
        if (!Auth::user()->can('update', User::class)) {
            return redirect()->route('utilisateurs.index')->with('error', 'Action non autorisée.');
        }

        // Récupérer l'utilisateur
        $utilisateur = DB::table('users')->where('id', $id)->first();

        if (!$utilisateur) {
            return redirect()->route('utilisateurs.index')->with('error', 'Utilisateur introuvable.');
        }

        // Basculer le statut
        $nouveauStatut = !$utilisateur->statut;

        DB::table('users')->where('id', $id)->update([
            'statut' => $nouveauStatut,
            'updated_at' => now(),
        ]);

        $message = $nouveauStatut ? 'Utilisateur activé avec succès.' : 'Utilisateur désactivé avec succès.';
        return redirect()->route('utilisateurs.index')->with('success', $message);
    }



    public function authenticate(Request $request)
    {
        Log::info('Tentative de connexion', ['email' => $request->email]);
    
        try {
            // Validation des données avec messages personnalisés
            $credentials = $request->validate([
                'email' => ['required', 'email', 'max:50'],
                'mdp' => ['required', 'string', 'min:8'],
            ], [
                'email.required' => 'L\'adresse email est obligatoire.',
                'email.email' => 'Veuillez entrer une adresse email valide.',
                'mdp.required' => 'Le mot de passe est obligatoire.',
                'mdp.min' => 'Le mot de passe doit contenir au moins 8 caractères.'
            ]);
    
            // Recherche de l'utilisateur avec eager loading si nécessaire
            $utilisateur = Utilisateur::where('email', $credentials['email'])->first();
    
            if (!$utilisateur) {
                Log::warning('Email non trouvé', ['email' => $credentials['email']]);
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors([
                        'email' => 'Identifiants incorrects',
                    ]);
            }
    
            // Vérification du mot de passe
            if (!Hash::check($credentials['mdp'], $utilisateur->mdp)) {
                Log::warning('Mot de passe incorrect', ['id' => $utilisateur->id]);
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors([
                        'email' => 'Identifiants incorrects', 
                    ]);
            }
    
            // Vérification du statut du compte
            if (!$utilisateur->statut) {
                Log::warning('Compte désactivé', ['id' => $utilisateur->id]);
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors([
                        'email' => 'Ce compte est désactivé. Contactez l\'administrateur.',
                    ]);
            }
    
            // Authentification et "remember me" optionnel
            Auth::login($utilisateur, $request->filled('remember'));
    
            // Régénération de la session pour éviter le fixation attack
            $request->session()->regenerate();
    
            Log::info('Connexion réussie', ['id' => $utilisateur->id]);
    
            // Redirection vers la page prévue ou dashboard
            return redirect()->intended(route('dashboard'))
                ->with('success', 'Bienvenue ' . $utilisateur->nom . ' !');
    
        } catch (\Exception $e) {
            Log::error('Erreur d\'authentification', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Une erreur est survenue. Veuillez réessayer.'
                ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Déconnecte l'utilisateur

        // Invalide la session pour éviter tout problème
        $request->session()->invalidate();

        // Régénère le token CSRF pour des raisons de sécurité
        $request->session()->regenerateToken();

        // Redirige vers la page de connexion
        return redirect()->route('login');
    }
}
