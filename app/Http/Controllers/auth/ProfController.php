<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use App\Models\Seance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfController extends Controller
{

    public function getQrCodePage(int $id_Seance){
            $qrcode = $this->getQrCode($id_Seance);
        return view("qrcodepage", compact('qrcode'));
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
}
