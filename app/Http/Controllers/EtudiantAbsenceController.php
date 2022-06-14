<?php

namespace App\Http\Controllers;

use App\Http\Traits\GeneralTrait;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Seance;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class EtudiantAbsenceController extends Controller
{
    //
    use GeneralTrait;

    public function marquerAbsence(Request $request){
        if(isset($request->id_seance) && isset($request->id_etudiant)){
            $id_seance = (int)$request->id_seance;
            $id_etudiant = $request->id_etudiant;
            $etudiant = Etudiant::find($id_etudiant);
            $seance = Seance::find($id_seance)->get();
            $etudiant->absence()->attach($id_seance,['is_absent' => 0]);
            return $this->returnSuccessMessage("Bien ajoute","200");
        }else{
            return $this->returnError('404',"veillez envoyer un id seance et id etudiant ");
        }
    }
//appele apres que le prof a fini le QR Code
    public function ajouterLesAbsents(Request $r){
        //par Qr Code on ne peut ajouter que les presents , on doit aussi ajouter les absents

        $id_seance = $r->id_seance;
        $s = Seance::find($id_seance);
        $s->seance_passe=1;
        $s->active=0;
        $s->save();

        $id_filiere = $r->id_filiere;
        $filiere = Filiere::find($id_filiere);
        $etudiantsPresents =  Etudiant::EstPresentDans($id_seance);
        $tous_les_etudiants = $filiere->etudiants()->get();
        $etudiants_absents = array();
        foreach ($tous_les_etudiants as $etudiant){
            $est_present = false;
            foreach ($etudiantsPresents as $ep){
                if($etudiant->id == $ep->id){
                    $est_present = true;
                    break;
                }
            }
            if($est_present == false){
                array_push($etudiants_absents,$etudiant);
            }
        }
        foreach ($etudiants_absents as $etudiants_absent){
            $etudiants_absent->absence()->attach($id_seance,['is_absent' => 1]);
        }
//        return $etudiants_absents;
        return view('prof');
    }

    public function seances_api(Request $r){
        $id_etudiant = $r->id_etudiant;

            $etudiant = Etudiant::find($id_etudiant);
            $filiere = Filiere::find($etudiant->filiere_id);
            $seances = $filiere->seances()->get();
            $newSeances = array();
            foreach ($seances as $s){
                if(isEmpty(Etudiant::IsEtudiantPresent($s->id,$id_etudiant) ) && $s->active==1){
                    array_push($newSeances,$s);
                }
            }
            return $this->returnData('senaces',$newSeances);


    }

}
