<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cps extends Model
{
    use HasFactory;

    protected $table = 'cps'; // Nom de la table
    protected $primaryKey = 'cps_id'; // Clé primaire
    public $timestamps = false; // Désactiver les colonnes created_at et updated_at si elles ne sont pas utilisées

    protected $fillable = [
        'cps_libelle',
        'departement_id',
        'commune_id',
        'arrondissement_id',
        'quartier_id',
    ]; // Colonnes modifiables

    // Relation avec la table groupement
    public function groupements()
    {
        return $this->hasMany(Groupement::class, 'cps_id', 'cps_id');
    }

    // Relation avec la table departement
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id', 'departement_id');
    }

    // Relation avec la table commune
    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_id', 'commune_id');
    }

    // Relation avec la table arrondissement
    public function arrondissement()
    {
        return $this->belongsTo(Arrondissement::class, 'arrondissement_id', 'arrondissement_id');
    }

    // Relation avec la table quartier
    public function quartier()
    {
        return $this->belongsTo(Quartier::class, 'quartier_id', 'quartier_id');
    }
}