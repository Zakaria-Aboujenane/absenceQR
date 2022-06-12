<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiLoginController extends Controller
{
    use AuthenticatesUsers;


    //
    public function __construct()
    {
        $this->middleware('guest:etudiant')->except('logout');
    }

    public function loginEtudiant(Request $request){
        $formFields = $request->validate([
            'email'   => ['required','email'],
            'password' => 'required'
        ]);

       if(!Auth::guard('etudiant')->attempt($formFields)){
           return  response([
               'message'=>'email ou mot de passe invalide'
           ],Response::HTTP_UNAUTHORIZED);//retourne 401
       }
       $user = Auth::guard('etudiant')->user();
       return $user;
    }
}
