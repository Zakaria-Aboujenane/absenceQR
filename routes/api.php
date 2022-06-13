<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\EtudiantAbsenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api'], function($router) {
    Route::post('login-etudiant',[LoginController::class,'login_etudiant_api']);
    Route::post('marquer_absence',[EtudiantAbsenceController::class,'marquerAbsence'])->middleware('auth.guard:etudiant-api');
//    Route::post('ajouter_absent',[EtudiantAbsenceController::class,'ajouterLesAbsents'])
//        ->middleware('auth.guard:etudiant-api');;
});

