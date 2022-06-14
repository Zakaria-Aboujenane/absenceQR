<?php

namespace App\Http\Controllers;

use App\Http\Traits\GeneralTrait;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Seance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;
use phpDocumentor\Reflection\Types\Boolean;

class StatsController extends Controller
{
    use GeneralTrait;//trait pour debeug wsf

/*
 * selon un mois donne
 * retourner un tableau comme : [ "4ISI"=>30,"3ISI"=>40 ]=> 30 est le pourcentage de presence
 */
    public function absence_par_filiere_mentuel($mois = 'last month'){
            $filieres  = Filiere::get();
            $start = new DateTime('first day of '.$mois);
            $end = new DateTime('last day of '.$mois);
            $resultat = array();
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
                    array_push($resultat,array(
                        "filiere"=>$f->intitule,
                        "pourcentages"=>(float)$pourc
                    ));
                }
            }
            return $resultat;
    }
    /*
     * selon un mois donne
     * retourner un tableau comme : [ "4ISI"=>30,"3ISI"=>40 ]=> 30 est le pourcentage de presence
     */
    public function absence_par_filiere_annuel($year = -1){
        if($year == -1){
            $year = date('Y');
        }
        $start = new DateTime('first day of January'.$year);
        $end = new DateTime('last day of December'.$year);
        $filieres  = Filiere::get();
        $resultat = array();
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
                array_push($resultat,array(
                    "filiere"=>$f->intitule,
                    "pourcentages"=>(float)$pourc
                ));
            }
        }
        return $resultat;

    }
    //nbr de filieres :
    public function nb_fils(){
        return Filiere::count();
    }
    //seances :
    //passe une annee , on va avoir les seances de cette annee (annee courante par defaut)
    public function seances_annuels($year='-1'){
        if($year == -1){
            $year = date('Y');
        }
        $firstOfyear = new DateTime('first day of January'.$year);
        $lastOfyear = new DateTime('last day of December'.$year);
        $seances  = Seance::betweenDates($firstOfyear,$lastOfyear)->get();

        return $seances;
    }
    //passe un mois , pour avoir les seances de ce mois (par defeaut last month)
    public function seances_mois($mois='last month'){

        $start = new DateTime('first day of '.$mois);
        $end = new DateTime('last day of '.$mois);

        $seances  = Seance::betweenDates($start,$end)->get();

        return $seances;

    }
    //nbre de seances pour une annee:
    public function nbr_seances_annuels($year=-1){
        if($year == -1){
            $year = date('Y');
        }
        $nbr =  $this->seances_annuels($year)->count();
        return $nbr;
    }
    //nbre seances pour un mois
    public function nbr_seances_mois($mois='last month'){
        $nbr =  $this->seances_mois($mois)->count();
        return $nbr;

    }

    // le nombre des absences:
    // absences selon l'annee , pour avoir les nombre des presences on passe : nombre_absents_annuel(0,2018)
    /*
 * @param $absent : si $absent = 0 on aura les etudiants present si $absent=1 on aura les etudiants absents
 */
    public function nombre_absents_annuel(int $absent=1, $year=-1){
        if($year == -1){
            $year = date('Y');
        }
        $absents = Etudiant::whereHas('absence', function($q) use ($absent) {
            $q->where('is_absent',$absent);
        })->get()->count();
        return $absents;
    }
    // nombre des absences selon mois absent=1 -> nbre absence , absence=0 -> nbre presences
    /*
* @param $absent : si $absent = 0 on aura les etudiants present si $absent=1 on aura les etudiants absents
* @param $mois : si on passe rien il va retourner les seances du mois dernier , si on passe un mois comme "June" on va avoir les seances de June
*/
    public function nombre_absents_mois(int $absent=1, $mois='last month'){
        if($mois == -1){
            $mois = date('m');
        }
        $seances = $this->seances_mois($mois);

        $absents = Etudiant::whereHas('absence', function($q) use ($absent) {
            $q->where('is_absent',$absent);
        })->get()->count();
        return $absent;
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



}
