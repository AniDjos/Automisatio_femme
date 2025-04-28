<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    protected $table = 'structure';
    protected $primaryKey = 'structure_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'structure',
    ];

    /**
     * Relation avec le modèle Appuis.
     */
    public function appuis()
    {
        return $this->hasMany(Appuis::class, 'structure_id', 'structure_id');
    }
}