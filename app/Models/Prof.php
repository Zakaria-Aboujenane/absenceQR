<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\Prof
 *
 * @property int $id
 * @property string $name
 * @property string $cin
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Prof newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prof newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prof query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prof whereCin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prof whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prof whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prof whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prof whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prof whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prof wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prof whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Filiere[] $filieres
 * @property-read int|null $filieres_count
 */
class Prof extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'prof';
    protected $fillable = [
        'name', 'email', 'password','cin'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function filieres()
    {
        return $this->belongsToMany(Filiere::class,'profs_filieres');
    }


}
