<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\EtudiantAbsenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
Route::post('login-etudiant',[LoginController::class,'login_etudiant_api']);
Route::group(['middleware' => 'api'], function($router) {
    Route::post('/test',[EtudiantAbsenceController::class,'seances_api'])->middleware('auth.guard:etudiant-api');
    Route::post('marquer_absence',[EtudiantAbsenceController::class,'marquerAbsence'])->middleware('auth.guard:etudiant-api');
//    Route::post('ajouter_absent',[EtudiantAbsenceController::class,'ajouterLesAbsents'])
//        ->middleware('auth.guard:etudiant-api');;
});

