<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $table = 'equipement';
    protected $primaryKey = 'equipment_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'equipment_libelle',
        'stat_equipement',
        'description_difficultie',
        'description_besoin',
        'groupement_id',
    ];

    /**
     * Relation avec le modèle Groupement.
     * Un équipement appartient à un groupement.
     */
    public function groupement()
    {
        return $this->belongsTo(Groupement::class, 'groupement_id', 'groupement_id');
    }
}