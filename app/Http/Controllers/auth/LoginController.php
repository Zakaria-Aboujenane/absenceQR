<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

//use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
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
}
