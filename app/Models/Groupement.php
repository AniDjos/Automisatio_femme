<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupement extends Model
{
    use HasFactory;

    // Nom explicite de la table
    protected $table = 'groupement';

    // Clé primaire personnalisée
    protected $primaryKey = 'groupement_id';

    // Désactiver l'incrémentation automatique si nécessaire
    public $incrementing = true;

    // Désactiver les timestamps si la table ne contient pas `created_at` et `updated_at`
    public $timestamps = false;

    // Colonnes pouvant être remplies via des formulaires
    protected $fillable = [
        'effectif',
        'nom',
        'commune',
        'arrondissement',
        'quartier',
        'statut',
        'date_creation',
        'revenu_mens',
        'benefice_mens',
        'depense_mens',
        'source_finance',
        'filiere_id',
        'agrement_id',
        'departement_id',
        'activite_principale_id',
        'activite_secondaire_id',
    ];

    /**
     * Relation avec le modèle Departement.
     * Un groupement appartient à un département.
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id', 'departement_id');
    }

    /**
     * Relation avec le modèle Commune.
     * Un groupement appartient à une commune.
     */
    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune', 'commune_id');
    }

    /**
     * Relation avec le modèle Arrondissement.
     * Un groupement appartient à un arrondissement.
     */
    public function arrondissement()
    {
        return $this->belongsTo(Arrondissement::class, 'arrondissement', 'arrondissement_id');
    }

    /**
     * Relation avec le modèle Quartier.
     * Un groupement appartient à un quartier.
     */
    public function quartier()
    {
        return $this->belongsTo(Quartier::class, 'quartier', 'quartier_id');
    }
    /**
     * Relation avec le modèle Filiere.
     * Un groupement appartient à une filière.
     */
    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'filiere_id', 'filiere_id');
    }
    /**
     * Relation avec le modèle Agrément.
     * Un groupement appartient à un agrément.
     */
    public function agremment()
    {
        return $this->belongsTo(Agrement::class, 'agrement_id', 'agrement_id');
    }
    /**
     * Relation avec le modèle ActivitePrincipale.
     * Un groupement appartient à une activité principale.
     */
    public function activitePrincipale()    
    {
        return $this->belongsTo(Filiere::class, 'activite_principale_id', 'filiere_id');
    }
    /**
     * Relation avec le modèle ActiviteSecondaire.
     * Un groupement appartient à une activité secondaire.
     */
    public function activiteSecondaire()
    {
        return $this->belongsTo(Filiere::class, 'activite_secondaire_id', 'filiere_id');
    }

    /**
     * Relation avec le modèle Equipement.
     * Un groupement peut avoir plusieurs équipements.
     */
    public function equipements()
    {
        return $this->hasMany(Equipement::class, 'groupement_id', 'groupement_id');
    }
    /**
     * Relation avec le modèle Agrément.
     * Un groupement peut avoir plusieurs agréments.
     */

    public function agrement()
    {
        return $this->belongsTo(Agrement::class, 'agrement_id', 'agrement_id');
    }

    
}
