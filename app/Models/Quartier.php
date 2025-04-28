<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quartier extends Model
{
    use HasFactory;

    protected $table = 'quartier';
    protected $primaryKey = 'quartier_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'quartier_libelle',
        'arrondissement_id',
    ];

    /**
     * Relation avec le modèle Arrondissement.
     * Un quartier appartient à un arrondissement.
     */
    public function arrondissement()
    {
        return $this->belongsTo(Arrondissement::class, 'arrondissement_id', 'arrondissement_id');
    }
    /**
     * Relation avec le modèle Cps.
     * Un quartier peut avoir plusieurs CPS.
     */
    public function cps()
    {
        return $this->hasMany(Cps::class, 'quartier_id', 'quartier_id');
    }
}

