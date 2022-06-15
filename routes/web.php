<?php

use App\Http\Controllers\EtudiantAbsenceController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\auth\LoginController;
use \App\Http\Controllers\auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Auth::routes();

Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm']);
Route::get('/register/prof', [RegisterController::class, 'showProfRegisterForm']);
Route::get('/register/etudiant', [RegisterController::class, 'showEtudiantRegisterForm']);

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/prof', [LoginController::class,'showProfLoginForm']);
Route::get('/login/etudiant', [LoginController::class,'showEtudiantLoginForm'])->name('login');




Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/login/prof', [LoginController::class,'profLogin']);
Route::post('/login/etudiant', [LoginController::class,'etudiantLogin']);

Route::post('/register/admin', [RegisterController::class, 'createAdmin']);
Route::post('/register/prof', [RegisterController::class, 'createProf']);
Route::post('/register/etudiant', [RegisterController::class, 'createEtudiant']);

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'adminData']);
    Route::get('/admin/seances',[\App\Http\Controllers\SeanceController::class,'listDesSeances']);
});

Route::group(['middleware' => 'auth:prof'], function () {
    Route::view('/prof', 'prof');
//    Route::get('/prof/seances',[\App\Http\Controllers\SeanceController::class,'listSeancesParProf']);
    Route::get('prof/qrcodepage/{id_seance}/{id_filiere}',[\App\Http\Controllers\auth\ProfController::class,'getQrCodePage'])->name('qr_code_page');
    Route::get('/ajax-request',[\App\Http\Controllers\auth\ProfController::class,'getQrCode']);
    Route::get('/fin_seance',[\App\Http\Controllers\EtudiantAbsenceController::class,'ajouterLesAbsents']);

});

Route::group(['middleware' => 'auth:etudiant'], function () {
    Route::view('/etudiant', 'etudiant');
});

Route::get('/logout', [LoginController::class,'logout'])->name('logout');


//testing:
Route::get('/test',[\App\Http\Controllers\testingController::class,'test_Filiere_Prof']);

Route::get('/AddSeances',[\App\Http\Controllers\AdminController::class, 'AddSeance']);
Route::post('/AddSeances',[\App\Http\Controllers\AdminController::class, 'AddSeance']);


Route::get('/AddSeances/{name}/{nbr_ocr}/{prof}/{filier}',[\App\Http\Controllers\AdminController::class, 'AddSeances']);
Route::post('/AddSeances/{name}/{nbr_ocr}/{prof}/{filier}',[\App\Http\Controllers\AdminController::class, 'AddSeances']);



Route::get('testing',[StatsController::class,'nb_fils']);

Route::get('/loadEtudiants',[\App\Http\Controllers\AdminController::class, 'LoadEtudiants']);

Route::get('/Seances',[\App\Http\Controllers\AdminController::class, 'ShowSeances']);
Route::get('/etudiants',[\App\Http\Controllers\AdminController::class, 'ShowEtudiants']);


Route::get('/ModifySeance/{idseance}',[\App\Http\Controllers\AdminController::class, 'ModifySeance']);
Route::post('/ModifySeance/{idseance}',[\App\Http\Controllers\AdminController::class, 'ModifySeance']);
Route::get('/DeleteSeance/{idseance}',[\App\Http\Controllers\AdminController::class, 'DeleteSeance']);
Route::get('/profs',[\App\Http\Controllers\AdminController::class, 'ShowProfs']);
Route::get('/filiers',[\App\Http\Controllers\AdminController::class, 'ShowFiliers']);

Route::get('/etudiants_par_seance/{idSeance}',[EtudiantAbsenceController::class,'getEtudiantsAbsentsParSeance']);
