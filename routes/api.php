<?php

use App\Http\Controllers\auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//middleware('auth.guard:etudiant-api'); pour s'assurer que l'etudiant est authentifie
Route::group(['middleware' => 'api'], function($router) {
    Route::post('login-etudiant',[LoginController::class,'login_etudiant_api']);
    Route::post('marquer_absence',[\App\Http\Controllers\EtudiantAbsenceController::class,'marquerAbsence']);
    Route::post('ajouter_absent',[\App\Http\Controllers\EtudiantAbsenceController::class,'ajouterLesAbsents']);
});

//Route::group(['middleware'=>'checkpassword'],function(){
////    Route::post('login',[LoginController::class,'loginEtudiant'])->middleware('auth.guard:etudiant-api');
//});
