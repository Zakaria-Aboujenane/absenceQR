<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Prof;
use \App\Models\Filiere;
use \App\Models\Seance;
use \App\Models\Etudiant;
use Carbon\Carbon;
use Nette\Utils\DateTime;


class AdminController extends Controller
{
    public function absence_par_filiere_annuels($year = -1){
        if($year == -1){
            $year = date('Y');
        }
        $start = new DateTime('first day of January'.$year);
        $end = new DateTime('last day of December'.$year);
        $filieres  = Filiere::get();
        $resultat_f = array();
        $resultat_p = array();
        foreach ($filieres as $f){
            $seances = Seance::betweenDates($start,$end)->where(function($q) use ($f) {
                $q->byFiliere($f->id);
                $q->SeancePasse();
            })->get();
            $nbr_abs=0;
            $nbr_pres=0;
            $nbr_seances=0;
            foreach ($seances as $s){
                $nbr_abs += $this->nbr_absence_par_seance($s->id);
                $nbr_pres += $this->nbr_presence_par_seance($s->id);
                $nbr_seances +=$nbr_abs+$nbr_pres;
            }
            if($nbr_seances >0){
                $pourc = number_format(($nbr_pres*100)/$nbr_seances, 2, '.', '') ;
                array_push($resultat_f,
                    $f->intitule);
                array_push($resultat_p,(float)$pourc);
            }
        }
        return ["result_f"=>$resultat_f,"result_p"=>$resultat_p];

    }
    public function AddSeance(Request $request){

        if($request->isMethod('post')){

            $name = $request->input('name');
            $nbr_ocr = $request->input('nbr_ocr');
            $prof = $request->input('prof');
            $filier = $request->input('filier');

            return redirect('/AddSeances/'.$name.'/'.$nbr_ocr.'/'.$prof.'/'.$filier);
        }

        $profs = Prof::all();
        $filiers = Filiere::all();
        $arr = array('profs' => $profs , 'filiers' => $filiers);
        return view('addSeance',$arr);
    }

    public function AddSeances(Request $request,$name,$nbr_ocr,$prof,$filier){

        if($request->isMethod('post')){
            for($i=0;$i<$nbr_ocr;$i++){
                $s = new Seance();
                $s->matiere = $name;
                $s->prof_id=$prof;
                $s->filiere_id=$filier;
                $s->date_debut = $request->input('date_s'.$i);
                $s->date_fin = '2022-02-02';
                $s->jours_de_semaine= "lundi"; //Carbon::createFromFormat('y/m/d',$request->input('date_s'.$i))->format('l');
                $s->heure_debut = $request->input('heure_s'.$i);
                $s->ref_salle = $request->input('salle_s'.$i);
                $s->active=0;
                $s->seance_passe=0;
                $s->save();
            }
            return redirect('/admin');
        }

        $arr = array('name' => $name , 'nbr_ocr' => $nbr_ocr ,'prof'=> $prof ,'filier' => $filier);
        return view('addSeances',$arr);
    }
    public function sayHi(){

    }
    public function adminData(){

        $arrC = $this->absence_par_filiere_annuels();

        $seance = $this->nbr_seances_annuel();
        $etudiants_absents = $this->nombre_absents_annuel(1);
        $etudiants_presents = $this->nombre_absents_annuel(0);
        $filieres = $arrC['result_f'];
//        echo $filieres[0];
        $nbr_fils = Filiere::count();
        $pourcentages = $arrC['result_p'];
        $arr = array('seance' => $seance);
        $pourcentagePresence=0;
        if(($etudiants_presents+$etudiants_absents)!=0 ){
            $pourcentagePresence = ($etudiants_presents*100)/($etudiants_presents+$etudiants_absents);
        }

        return view('admin',["seances"=>$seance,
            "etudiants_absents"=>$etudiants_absents,
            "etudiants_presents"=>$etudiants_presents,
            "filieres"=>$filieres,
            "nbrFils"=>$nbr_fils,
            "pourcentages"=>$pourcentages,
            "pourcentage_presence"=>number_format((float)$pourcentagePresence, 2, '.', ''),
            ]);
    }
    public function ShowSeances(){
        $seance = Seance::all();
        $arr = array('seance' => $seance);
        return view('seances.seances',$arr);
    }

    public function ShowEtudiants(){
        $etudiant = Etudiant::all();
        $arr = array('etudiant' => $etudiant);
        return view('etudiant',$arr);
    }
    public function ShowProfs(){
        $profs = Prof::all();
        $arr = array('profs' => $profs);
        return view('profs',$arr);
    }

    public function ShowFiliers(){
        $filiers = Filiere::all();
        $arr = array('filiers' => $filiers);
        return view('filiers',$arr);
    }

    public function LoadEtudiants(){



        return redirect('/admin');
    }
    public function ModifySeance(Request $request, $idseance)
    {

        if ($request->isMethod('post')) {
            $newseance = Seance::find($idseance);
            $newseance->matiere=$request->input('name');
            $newseance->filiere_id=$request->input('filier');
            $newseance->prof_id=$request->input('prof');
            $newseance->date_debut=$request->input('date');
            $newseance->heure_debut=$request->input('heure');
            $newseance->ref_salle=$request->input('salle');
            $newseance->save();
            return redirect("/Seances");
        }

        $profs = Prof::all();
        $filiers = Filiere::all();
        $arrDD = array('profs' => $profs , 'filiers'=> $filiers);
        $seance = seance::find($idseance);
        $arr = array('seance' => $seance);
        return view('seances.ModifySeance', $arr , $arrDD);
    }


    public function DeleteSeance($idseance)
    {
        $seance = Seance::find($idseance);
        $seance->delete();
        return redirect()->back();
    }



    // nbre des absences selon une seance :
    public function nbr_absence_par_seance($id_seance){
        return $absents = Etudiant::whereHas('absence', function($q) use ($id_seance) {
            $q->where('seance_id',$id_seance)->where('is_absent',1);
        })->get()->count();
    }
    public function nbr_presence_par_seance($id_seance){
        return $absents = Etudiant::whereHas('absence', function($q) use ($id_seance) {
            $q->where('seance_id',$id_seance)->where('is_absent',0);
        })->get()->count();
    }


    public function nombre_absents_annuel(int $absent=1, $year=-1){
        if($year == -1){
            $year = date('Y');
        }
        $absents = Etudiant::whereHas('absence', function($q) use ($absent) {
            return $q->where('is_absent',$absent);
        })->get()->count();
        return $absents;
    }

    public function nbr_seances_annuel($year=-1){
        if($year == -1){
            $year = date('Y');
        }
        $nbr =  $this->seances_annuels($year)->count();
        return $nbr;
    }

    public function seances_annuels($year='-1'){
        if($year == -1){
            $year = date('Y');
        }
        $firstOfyear = new DateTime('first day of January'.$year);
        $lastOfyear = new DateTime('last day of December'.$year);
        $seances  = Seance::betweenDates($firstOfyear,$lastOfyear)->get();

        return $seances;
    }

}
