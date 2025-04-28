<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    protected $table = 'filiere';
    protected $primaryKey = 'filiere_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'filiere_libelle',
    ];

    /**
     * Relation avec le modèle Groupement.
     * Une filière peut être associée à plusieurs groupements.
     */
    public function groupements()
    {
        return $this->hasMany(Groupement::class, 'filiere_id', 'filiere_id');
    }
}