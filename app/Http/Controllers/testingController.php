<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class testingController extends Controller
{
    public function testi(){
        $etudiant = new Etudiant();
        $etudiant->name = "Zakaria";
        $etudiant->email="zoygberd@gmail.com";
        $etudiant->password="koko123123";
        $etudiant->cin = "CD45678";
        $etudiant->email_parent = "parent@g.com";
        $etudiant->cne = "N5745678";
//        $etudiant->filiere_id = 1;
        $etudiant->save();


//        $fil = new Filiere();
//        $fil->niveau = "4 eme Annee";
//        $fil->intitule="4ISI";

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
        $f = Filiere::find(1);
        echo $f->etudiants()->save();
//        echo $f->intitule;
    }
}
