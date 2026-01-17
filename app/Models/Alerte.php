<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'message',
        'type',
        'priorite',
        'auteur_id',
        'destinataire_id',
        'pour_tous',
        'lu',
        'date_expiration',
    ];

    protected $casts = [
        'pour_tous' => 'boolean',
        'lu' => 'boolean',
        'date_expiration' => 'datetime',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }

    public function scopeNonLues($query)
    {
        return $query->where('lu', false);
    }

    public function scopePourUtilisateur($query, $userId)
    {
        return $query->where(function ($q) use ($userId) {
            $q->where('destinataire_id', $userId)
              ->orWhere('pour_tous', true);
        });
    }

    public function getTypeIconAttribute()
    {
        return match($this->type) {
            'changement_salle' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z',
            'disponibilite' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            'paiement' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z',
            default => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        };
    }

    public function getPrioriteColorAttribute()
    {
        return match($this->priorite) {
            'basse' => 'gray',
            'moyenne' => 'blue',
            'haute' => 'orange',
            'urgente' => 'red',
            default => 'gray',
        };
    }
}
