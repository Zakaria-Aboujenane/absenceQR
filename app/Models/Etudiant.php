<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


/**
 * App\Models\Etudiant
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $cin
 * @property string $cne
 * @property string $email_parent
 * @property string|null $email_verified_at
 * @property string $password
 * @property int $filiere_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereCin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereCne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereEmailParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereFiliereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Filiere|null $filiere
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Seance[] $seances
 * @property-read int|null $seances_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Seance[] $absence
 * @property-read int|null $absence_count
 * @method static Builder|Etudiant estPresentDans($id_seance)
 */
class Etudiant extends Authenticatable implements JWTSubject
{
    public static int $static_id = -1;
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'etudiant';
    protected $fillable = [
        'name', 'email', 'password','email_parent','cne','cin','filiere_id'
    ];
    protected $hidden;
    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }
    public function absence()
    {
        return $this->belongsToMany(Seance::class,'absence');
    }
    public function scopeEstPresentDans($query,$id_seance){
        self::$static_id = $id_seance;

        return Etudiant::whereHas('absence', function ($query) {
            $query->where('seance_id', self::$static_id );
        })->get();
    }
    public function scopeIsEtudiantPresent($query,$id_seance,$id_etud){
        return  $query->whereHas('absence', function ($query) use ($id_etud, $id_seance) {
            $query->where('seance_id', $id_seance )->where('etudiant_id',$id_etud);
        });
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
