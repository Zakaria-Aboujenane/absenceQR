<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\ProfController;
use App\Http\Controllers\EtudiantAbsenceController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\testingController;
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
    Route::get('prof/qrcodepage/{id_seance}/{id_filiere}',[ProfController::class,'getQrCodePage'])->name('qr_code_page');
    Route::get('/ajax-request',[ProfController::class,'getQrCode']);
    Route::get('/fin_seance',[EtudiantAbsenceController::class,'ajouterLesAbsents']);
});

Route::group(['middleware' => 'auth:etudiant'], function () {
    Route::view('/etudiant', 'etudiant');
});

Route::get('/logout', [LoginController::class,'logout'])->name('logout');


//testing:
Route::get('/test',[testingController::class,'test_Filiere_Prof']);

Route::get('/AddSeances',[AdminController::class, 'AddSeance']);
Route::post('/AddSeances',[AdminController::class, 'AddSeance']);


Route::get('/AddSeances/{name}/{nbr_ocr}/{prof}/{filier}',[AdminController::class, 'AddSeances']);
Route::post('/AddSeances/{name}/{nbr_ocr}/{prof}/{filier}',[AdminController::class, 'AddSeances']);



Route::get('testing',[StatsController::class,'nb_fils']);

Route::get('/loadEtudiants',[AdminController::class, 'LoadEtudiants']);

Route::get('/Seances',[AdminController::class, 'ShowSeances']);
Route::get('/etudiants',[AdminController::class, 'ShowEtudiants']);


Route::get('/ModifySeance/{idseance}',[AdminController::class, 'ModifySeance']);
Route::post('/ModifySeance/{idseance}',[AdminController::class, 'ModifySeance']);
Route::get('/DeleteSeance/{idseance}',[AdminController::class, 'DeleteSeance']);
Route::get('/profs',[AdminController::class, 'ShowProfs']);
Route::get('/filiers',[AdminController::class, 'ShowFiliers']);

Route::get('/etudiants_par_seance/{idSeance}',[EtudiantAbsenceController::class,'getEtudiantsAbsentsParSeance']);
Route::get('/seances_par_etudiant/{idEtudiant}',[EtudiantAbsenceController::class,'getEtudiantSeancesAbsParEtudiant']);

Route::get('/testmail/{id_seance}/{id_etudiant}',[testingController::class,'sendMailTest']);
Route::get('/testexcel',[testingController::class,'getASheet']);
