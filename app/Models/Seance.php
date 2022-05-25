<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Seance
 *
 * @property int $id
 * @property string $matiere
 * @property string $ref_salle
 * @property string $date_debut
 * @property string $date_fin
 * @property string $heure_debut
 * @property string $jours_de_semaine
 * @property int $active
 * @property int $seance_passe
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Etudiant[] $etudiants
 * @property-read int|null $etudiants_count
 * @property-read Seance|null $filiere
 * @method static \Illuminate\Database\Eloquent\Builder|Seance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereHeureDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereJoursDeSemaine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereMatiere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereRefSalle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereSeancePasse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class,'absence');
    }
}
