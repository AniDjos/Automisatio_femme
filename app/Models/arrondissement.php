<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrondissement extends Model
{
    use HasFactory;

    protected $table = 'arrondissement';
    protected $primaryKey = 'arrondissement_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'arrondissement_libelle',
        'commune_id',
    ];

    /**
     * Relation avec le modèle Commune.
     * Un arrondissement appartient à une commune.
     */
    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_id', 'commune_id');
    }

    /**
     * Relation avec le modèle Quartier.
     * Un arrondissement peut avoir plusieurs quartiers.
     */
    public function quartiers()
    {
        return $this->hasMany(Quartier::class, 'arrondissement_id', 'arrondissement_id');
    }

    /**
     * Relation avec le modèle Cps.
     * Un arrondissement peut avoir plusieurs CPS.
     */
    public function cps()
    {
        return $this->hasMany(Cps::class, 'arrondissement_id', 'arrondissement_id');
    }
}