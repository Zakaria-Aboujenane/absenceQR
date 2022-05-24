<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Filiere
 *
 * @property int $id
 * @property string $intitule
 * @property string $niveau
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere query()
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere whereIntitule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere whereNiveau($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Filiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule','niveau'
    ];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
}
