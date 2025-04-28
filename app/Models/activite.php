<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    // Nom de la table associée
    protected $table = 'activite';

    // Colonnes autorisées pour l'insertion en masse
    protected $fillable = [
        'activite',
        'activite_id',
    ];

    /**
     * Relation avec les groupements (une activité peut être associée à plusieurs groupements)
     */
    public function groupements()
    {
        return $this->hasMany(Groupement::class, 'activite_principale');
    }
}