<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfController extends Controller
{

    public function getQrCodePage(int $id_Seance){
            $qrcode = $this->getQrCode($id_Seance);
        return view("qrcodepage", compact('qrcode'));
    }
    public function getQrCode(int $id_Seance){
        $qrcode_string = QrCode::all()->first();
        $qrcode_string = $id_Seance."|".$qrcode_string;
        $qrcode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($qrcode_string);
        return $qrcode;
    }
}
