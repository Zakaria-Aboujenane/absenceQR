<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Filiere;
use App\Models\Prof;
use App\Models\QrCode;
use App\Models\Seance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfController extends Controller
{

    public function getQrCodePage(int $id_Seance,int $id_filiere){
            $qrcode = $this->getQrCode($id_Seance);
            $s=Seance::find($id_Seance);
            $s->active=1;
            $s->save();
        return view("qrcodepage", compact('qrcode','id_filiere','id_Seance'));
    }
    public function getQrCode(){
        $qrcode_string =$this->regenerateQrCode();
        $qrcode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(500)->generate($qrcode_string);
        return $qrcode;
    }

    public function regenerateQrCode(){
        $var = Str::random(32);
        QrCode::setqrtoken($var);
        return QrCode::all()->first()->qr_code_token;
    }

    public function getProfsParFiliere($id_filiere){

        return  Prof::whereHas('profs_filieres', function ($query) use ($id_filiere) {
            $query->where('filiere_id', $id_filiere );
        })->get();

}
}
