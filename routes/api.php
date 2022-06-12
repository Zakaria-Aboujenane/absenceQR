<?php

use App\Http\Controllers\auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//here u need api auth
//Route::group(['middleware'=>'auth:api'],function (){
//
//});
Route::post('login-etudiant',[LoginController::class,'login_etudiant_api']);
//Route::group(['middleware' => 'api'], function($router) {
//
//});

//Route::group(['middleware'=>'checkpassword'],function(){
////    Route::post('login',[LoginController::class,'loginEtudiant'])->middleware('auth.guard:etudiant-api');
//});
