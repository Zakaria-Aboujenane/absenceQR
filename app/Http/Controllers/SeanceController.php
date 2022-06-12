<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Prof;
use App\Models\Seance;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    //
    public function listDesSeances(){
        $seances  = Seance::all();
        return view('seances.seances',['seances'=>$seances]);
    }
    public function listDesSeancesParDate($date){
        $seances  = Seance::whereDate('date_debut','=',$date);
        return view('seances.seances',['seances'=>$seances]);
    }
    public function listSeancesParFilire($idFil){
        if(auth('prof') != null ){
           $filiere = Filiere::find($idFil);
           $seances = $filiere->seances();
        }else {
            return view('error', ['err' => "Vous n'avez pas de droit pour voir cette page"]);
        }
    }
    public function listSeancesParProf(){
        if(auth('prof') != null ){
            $idProf = auth('prof')->id();
            $prof = Prof::find($idProf);
            $seances = Seance::seancesDuProf($idProf)->ValidSeances()->Today();
            return view('',['seances'=>$seances]);
        }else {
            return view('error', ['err' => "Vous n'avez pas de droit pour voir cette page"]);
        }
    }
    public function listFilieresParProf(){
        if(auth('prof') != null ){
            $idProf = auth('prof')->id();
            $p = Prof::find($idProf);
            $fs = $p->filieres()->get();
            return view('',['filieres'=>$fs]);
        }else {
            return view('error', ['err' => "Vous n'avez pas de droit pour voir cette page"]);
        }
    }
    public function setSeanceActive($idS){
        $seance = Seance::find($idS);
        $seance->active=1;
        $seance->seance_passe=0;
        $seance->save();
    }
    public function setSeancePassed($idS){
        $seance = Seance::find($idS);
        $seance->active=0;
        $seance->seance_passe=1;
        $seance->save();
    }
    public function reseTAllforToday(){
        $seances = Seance::today()->ValidSeances()->get();
        foreach ($seances as $s) {
            $s->seance_passe=0;
            $s->active=0;
            $s->save();
        }
    }
}
