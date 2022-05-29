<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Prof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class testingController extends Controller
{
    public function test_Filiere_Etudiant(){
//        $etudiant = new Etudiant();
//        $etudiant->name = "Ahmed";
//        $etudiant->email="ahmed@gmail.com";
//        $etudiant->password= Hash::make("lol123123");
//        $etudiant->cin = "CD45678";
//        $etudiant->email_parent = "parent@g.com";
//        $etudiant->cne = "N5745678";
//
//        $fil = new Filiere();
//        $fil->niveau = "4 eme Annee";
//        $fil->intitule="4ISI";
//        $fil->save();
//        $f = Filiere::find(1);
//        $etudiant->filiere_id = 1;
//        $etudiant->save();

//        $etudiant->save();
//        $f = Filiere::find(1);
//        $all =  $f->etudiants()->get();
//        foreach ($all as $e) {
//            echo $e;
//        }



//        $fil = Filiere::create([
//            'intitule' => '4ISI1',
//            'niveau'=>'4 eme ann',
//        ]);
//        Etudiant::create([
//            'name'=>"Zakaria",
//            "email"=>'ziko@gmail.com',
//            "password"=> Hash::make("koko123123"),
//            "cne"=>"CD5678",
//            "cin"=>'N345678',
//            "email_parent"=>"email@e.com",
//            "filiere_id"=>1,
//
//        ]);

//        echo $f->intitule;
    }

    public function test_Filiere_Prof(){
            $f2 = new Filiere();
            $f2->intitule="STID";
            $f2->niveau="2 eme annee";
            $f2->save();


//            $p = new Prof();
//            $p->name="ommor";
//            $p->email="ommoro@gmail.com";
//            $p->cin = "CD456789";
//            $p->password=Hash::make("lol123123");
//            $p->save();
        $p = Prof::find(1);
        $f3 = Filiere::find(1);
            $f = Filiere::find(1);
            $p->filieres()->save($f);
            $p->filieres()->save($f2);
            $p->filieres()->save($f3);



            $p = Prof::find(1);
            $fs = $p->filieres()->get();
        foreach ($fs as $f) {
                    echo $f->seances()->get();
            }





    }
}
