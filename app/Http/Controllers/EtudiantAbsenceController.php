<?php

namespace App\Http\Controllers;

use App\Http\Traits\GeneralTrait;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Prof;
use App\Models\QrCode;
use App\Models\Seance;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class EtudiantAbsenceController extends Controller
{
    //
    use GeneralTrait;
    public function checkQRCode(String $QRCode){
        if(QrCode::all()->first()->qr_code_token == $QRCode){
            return true;
        }
        return false;
    }
    public function marquerAbsence(Request $request){
        if(isset($request->id_seance) && isset($request->id_etudiant)){
            $qr_code_token = $request->qr_code_token;
            if($this->checkQRCode($qr_code_token)) {
                $id_seance = (int)$request->id_seance;
                $id_etudiant = $request->id_etudiant;
                $etudiant = Etudiant::find($id_etudiant);
                $seance = Seance::find($id_seance)->get();
                if (Etudiant::isEtudiantPresent($id_seance, $id_etudiant)->first() == NULL) {
                    $etudiant->absence()->attach($id_seance, ['is_absent' => 0]);
                    return $this->returnSuccessMessage("Vous avez marque votre absence avec succes", "200");
                } else {
                    return $this->returnError('200', "cet etudiant ne peut pas marquer son absence");
                }
            }else{
                return $this->returnError('QRCODEINV','veuillez scanner le qr code a nouveau');
            }
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
                if(Etudiant::isEtudiantPresent($s->id,$id_etudiant)->first()==NULL  && $s->active==1 && $s->seance_passe==0){
                    $prof = Prof::find($s->prof_id);
                    array_push($newSeances,array(
                        "id"=>$s->id,
                        "matiere"=>$s->matiere,
                        "heure_debut"=>$s->heure_debut,
                        "ref_salle"=>$s->ref_salle,
                        "prof"=> $prof->name,
                    ));
                }
            }
            return $this->returnData('seances',$newSeances);
    }

    public function getEtudiantsAbsentsParSeance($idSeance)
    {
        $etudiants = Etudiant::whereHas('absence', function ($query) use ($idSeance) {
            return $query->where('seance_id', $idSeance);
        })->get();
        $listEtud = array();
        foreach ($etudiants as $e ){
            array_push($listEtud,array(
                "id_etudiant"=>$e->id,
                "name"=>$e->name,
                "CNE"=>$e->cne,
                "email_parent"=>$e->email_parent,
                "id_seance"=>$idSeance,
            ));
        }
        return $listEtud;

    }

}
