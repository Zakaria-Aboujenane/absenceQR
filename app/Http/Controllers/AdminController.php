<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Prof;
use \App\Models\Filiere;
use \App\Models\Seance;
use \App\Models\Etudiant;

use Carbon\Carbon;

class AdminController extends Controller
{
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

    public function adminData(){
        $seance = Seance::all();
        $arr = array('seance' => $seance);
        return view('admin',$arr);
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
        return redirect(url()->previous());
    }

}
