<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Nette\Utils\DateTime;
use phpDocumentor\Reflection\Types\AbstractList;

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
 * @property int $filiere_id
 * @method static \Illuminate\Database\Eloquent\Builder|Seance active()
 * @method static \Illuminate\Database\Eloquent\Builder|Seance seancePasse()
 * @method static \Illuminate\Database\Eloquent\Builder|Seance today()
 * @method static \Illuminate\Database\Eloquent\Builder|Seance validSeances()
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereFiliereId($value)
 * @property int $prof_id
 * @property-read \App\Models\Prof|null $prof
 * @method static \Illuminate\Database\Eloquent\Builder|Seance seancesDuProf($idProf)
 * @method static \Illuminate\Database\Eloquent\Builder|Seance whereProfId($value)
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
        return $this->belongsTo(Filiere::class);
    }
    public function prof()
    {
        return $this->belongsTo(Prof::class);
    }
    public function absence()
    {
        return $this->belongsToMany(Etudiant::class,'absence');
    }

    public function marquerAbsence(){

    }
    public function scopeToday($query){


        $date = now();
        $d    = new DateTime($date);
        $d->format('l');  //pass l for lion aphabet in format
        $today =  $this->translateDayName($d->format('l'));
        echo $today;
        return $query->where('jours_de_semaine','like',"%{$today}%");
    }
    public function scopeValidSeances( $query)
    {
        $date = now();
        return $query->whereDate('date_debut','<=',$date)->whereDate('date_fin','>=',$date);
//        echo $date;
    }
    public function scopeActive($query){
        return Seance::whereActive(1);
    }
    public function scopeSeancePasse($query){
        return Seance::whereSeancePasse(1);
    }
    public function scopeSeancesDuProf($query,$idProf){
        $mytime = Carbon::now();
        $str_time = date('Y-m-d',strtotime($mytime->toDateTimeString()))."";
//        dd($str_time);
        return Seance::where('prof_id',$idProf)->whereDate('date_debut','=',$str_time);
    }
    public function translateDayName($dayname):string{
        $arrEN = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
        $arrFR = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
        $i=0;
        foreach ($arrEN as $day) {
            if($day==$dayname){
                return $arrFR[$i];
            }
            $i++;
        }
    }
}
