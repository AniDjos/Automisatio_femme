<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appuis extends Model
{
    use HasFactory;

    protected $table = 'appuis';
    protected $primaryKey = 'appuis_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'type_appuis',
        'description',
        'date_appuis',
        'groupement_id',
        'structure_id',
    ];

    /**
     * Relation avec le modèle Groupement.
     * Un appui appartient à un groupement.
     */
    public function groupement()
    {
        return $this->belongsTo(Groupement::class, 'groupement_id', 'groupement_id');
    }
    

    public function structure()
    {
        return $this->belongsTo(Structure::class, 'structure_id', 'structure_id');
    }

    /**
     * Relation avec le modèle User.
     * Un appui appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}