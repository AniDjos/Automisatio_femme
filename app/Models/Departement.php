<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departement';
    protected $primaryKey = 'departement_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'departement_libelle',
    ];

    /**
     * Relation avec le modèle Commune.
     * Un département peut avoir plusieurs communes.
     */
    public function communes()
    {
        return $this->hasMany(Commune::class, 'departement_id', 'departement_id');
    }

    /**
     * Relation avec le modèle Arrondissement.
     * Un département peut avoir plusieurs arrondissements.
     */
    public function arrondissements()
    {
        return $this->hasMany(Arrondissement::class, 'departement_id', 'departement_id');
    }
    /**
     * Relation avec le modèle Cps.
     * Un département peut avoir plusieurs CPS.
     */
    public function cps()
    {
        return $this->hasMany(Cps::class, 'departement_id', 'departement_id');
    }
    /**
     * Relation avec le modèle Groupement.
     * Un département peut avoir plusieurs groupements.
     */
    public function groupements()
    {
        return $this->hasMany(Groupement::class, 'departement_id', 'departement_id');
    }
}