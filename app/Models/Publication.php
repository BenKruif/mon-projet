<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'contenu',
        'image',
        'categorie',
        'est_public',
        'est_epingle',
        'auteur_id',
        'date_publication',
        'date_expiration',
    ];

    protected $casts = [
        'est_public' => 'boolean',
        'est_epingle' => 'boolean',
        'date_publication' => 'datetime',
        'date_expiration' => 'datetime',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function scopePubliques($query)
    {
        return $query->where('est_public', true);
    }

    public function scopeActives($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('date_expiration')
              ->orWhere('date_expiration', '>', now());
        });
    }

    public function scopeEpinglees($query)
    {
        return $query->where('est_epingle', true);
    }

    public function getCategorieColorAttribute()
    {
        return match($this->categorie) {
            'annonce' => 'blue',
            'evenement' => 'purple',
            'information' => 'green',
            'urgent' => 'red',
            default => 'gray',
        };
    }

    public function getCategorieIconAttribute()
    {
        return match($this->categorie) {
            'annonce' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z',
            'evenement' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
            'information' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            'urgent' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
            default => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        };
    }
}
