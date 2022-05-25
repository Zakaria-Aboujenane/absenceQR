<?php

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
    Route::view('/admin', 'admin');
});

Route::group(['middleware' => 'auth:prof'], function () {
    Route::view('/prof', 'prof');
});

Route::group(['middleware' => 'auth:etudiant'], function () {
    Route::view('/etudiant', 'etudiant');
});

Route::get('/logout', [LoginController::class,'logout'])->name('logout');


//testing:
Route::get('/test',[\App\Http\Controllers\testingController::class,'test_Filiere_Prof']);


