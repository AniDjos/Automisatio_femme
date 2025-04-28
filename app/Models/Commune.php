<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $table = 'commune';
    protected $primaryKey = 'commune_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'commune_libelle',
        'departement_id',
    ];

    /**
     * Relation avec le modèle Departement.
     * Une commune appartient à un département.
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id', 'departement_id');
    }

    /**
     * Relation avec le modèle Arrondissement.
     * Une commune peut avoir plusieurs arrondissements.
     */
    public function arrondissements()
    {
        return $this->hasMany(Arrondissement::class, 'commune_id', 'commune_id');
    }

    /**
     * Relation avec le modèle Cps.
     * Une commune peut avoir plusieurs CPS.
     */
    public function cps()
    {
        return $this->hasMany(Cps::class, 'commune_id', 'commune_id');
    }
}