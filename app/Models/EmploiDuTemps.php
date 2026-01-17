<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiDuTemps extends Model
{
    use HasFactory;

    protected $table = 'emploi_du_temps';

    protected $fillable = [
        'matiere_id',
        'professeur_id',
        'jour',
        'heure_debut',
        'heure_fin',
        'salle',
        'classe',
        'actif',
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function professeur()
    {
        return $this->belongsTo(User::class, 'professeur_id');
    }
}
