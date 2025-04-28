<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'utilisateur';

    /**
     * La clé primaire associée à la table.
     *
     * @var string
     */
    protected $primaryKey = 'utilisateur_id';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mdp',
        'role',
        'statut',
    ];

    /**
     * Indique si le modèle doit gérer les colonnes `created_at` et `updated_at`.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Les attributs qui doivent être castés en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'statut' => 'boolean',
    ];

    /**
     * Les attributs qui doivent être cachés pour les tableaux.
     *
     * @var array
     */
    protected $hidden = [
        'mdp',
        'remember_token',
    ];

    /**
     * Récupère le mot de passe pour l'authentification.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->mdp; // Spécifie que le champ 'mdp' contient le mot de passe
    }
}
