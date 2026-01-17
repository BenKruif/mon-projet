<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'matiere_id',
        'professeur_id',
        'note',
        'type',
        'semestre',
        'commentaire',
        'date_evaluation',
    ];

    protected $casts = [
        'date_evaluation' => 'date',
        'note' => 'decimal:2',
    ];

    public function etudiant()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function professeur()
    {
        return $this->belongsTo(User::class, 'professeur_id');
    }
}
