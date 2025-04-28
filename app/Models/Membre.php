<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    // Nom explicite de la table
    protected $table = 'membre';
    protected $primaryKey = 'membre_id'; 
    public $timestamps = true; 

    protected $fillable = [
        'nom_membre',
        'prenom_membre',
        'role_stimule',
        'telephone',
        'groupement_id',
    ];

    /**
     * Relation avec le modèle groupement.
     * Un memebre appartient à un groupement.
     */
    public function groupement()
    {
        return $this->belongsTo(Groupement::class, 'groupement_id', 'groupement_id');
    }
}
