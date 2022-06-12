<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Filiere;
use App\Models\Seance;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;
use Symfony\Component\HttpFoundation\Response;

//use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers,GeneralTrait;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:prof')->except('logout');
        $this->middleware('guest:etudiant')->except('logout');
    }
// admin login :
    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }
    public function adminLogin(Request $request)
    {
        $formFields = $request->validate([
            'email'   => ['required','email'],
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/admin')->with('message','Logged in ');
        }
        echo "noope";
//        return back()->withInput($request->only('email', 'remember'))
//            ->withErrors(['email'=>'invalid email'])->onlyInput('email');
    }

//    Prof loggin:
    public function showProfLoginForm()
    {
        return view('auth.login', ['url' => 'prof']);
    }
    public function profLogin(Request $request)
    {
        $formFields = $request->validate([
            'email'   => ['required','email'],
            'password' => 'required'
        ]);

        if (Auth::guard('prof')->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/prof')->with('message','Logged in ');
        }
        return back()->withInput($request->only('email', 'remember'))
            ->withErrors(['email'=>'invalid email'])->onlyInput('email');
    }

//    Etudiant login :
    public function showEtudiantLoginForm()
    {

        return view('auth.login', ['url' => 'etudiant']);
    }
    public function etudiantLogin(Request $request)
    {
        $formFields = $request->validate([
            'email'   => ['required','email'],
            'password' => 'required'
        ]);

        if (Auth::guard('etudiant')->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/etudiant')->with('message','Logged in ');
        }
        return back()->withInput($request->only('email', 'remember'))
            ->withErrors(['email'=>'invalid email'])->onlyInput('email');
    }



    public function logout()
    {
        \Illuminate\Support\Facades\Session::flush();
        Auth::logout();
        return redirect('/');
    }



    public function login_etudiant_api(Request $request){
        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('etudiant-api')->attempt($credentials);

            if (!$token)
                return $this->returnError('E001', 'email ou mot de passe invalide');

            $etudiant = Auth::guard('etudiant-api')->user();
            $etudiant->api_token = $token;
//            retourner l'etudiant avec sa filiere et ses seances:
            $filiere = Filiere::find($etudiant->filiere_id);
            $etudiant->fil = $filiere;
            $seances = $filiere->seances();
            $etudiant->seances = $seances;

            return $this->returnData('admin', $etudiant);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
