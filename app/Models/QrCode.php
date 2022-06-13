<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;
    protected $table = 'qrcode';

    protected $fillable = [
       'qr_code_token'
        ];

    public function scopeSetqrtoken($query,$qr_string){
            $query->where('id','=',1)->update(['qr_code_token'=>$qr_string]);
    }
}
