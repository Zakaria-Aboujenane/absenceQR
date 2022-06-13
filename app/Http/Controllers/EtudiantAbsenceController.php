<?php

namespace App\Http\Controllers;

use App\Http\Traits\GeneralTrait;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Seance;
use Illuminate\Http\Request;

class EtudiantAbsenceController extends Controller
{
    //
    use GeneralTrait;

    public function marquerAbsence(Request $request){
            $id_seance = (int)$request->id_seance;
            $id_etudiant = $request->id_etudiant;
            $etudiant = Etudiant::find($id_etudiant);
            $seance = Seance::find($id_seance)->get();
            $etudiant->absence()->attach($id_seance,['is_absent' => 0]);
            return $this->returnSuccessMessage("Bien ajoute","200");

    }

    public function ajouterLesAbsents(Request $request){
        $id_filiere = $request->id_filiere;
        $id_seance = $request->id_seance;
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

        return $etudiants_absents;

    }
}
