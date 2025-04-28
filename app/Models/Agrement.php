<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agrement extends Model
{
    use HasFactory;

    protected $table = 'agrement'; // Nom de la table
    protected $primaryKey = 'agrement_id'; // Clé primaire

    protected $fillable = [
        'structure',
        'reference',
        'document',
        'date_deliver',
        'groupement_id',
    ];

    public function groupement()
    {
        return $this->belongsTo(Groupement::class, 'groupement_id', 'groupement_id');
    }
}