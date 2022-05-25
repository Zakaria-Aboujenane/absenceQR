<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;


    protected $fillable = [
        'matiere', 'ref_salle',
        'date_debut','date_fin',
        'heure_debut','jours_sem',
        'active','seance_passe'
    ];

    public function filiere()
    {
        return $this->belongsTo(Seance::class);
    }

}
