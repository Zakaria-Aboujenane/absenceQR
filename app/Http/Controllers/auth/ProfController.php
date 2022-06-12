<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfController extends Controller
{
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

        if ($prof = Auth::guard('prof')->attempt($formFields)) {
            $request->session()->regenerate();
//            return redirect('/prof')->with('message','Logged in ')->with('prof');
            return $prof;
        }
        return back()->withInput($request->only('email', 'remember'))
            ->withErrors(['email'=>'invalid email'])->onlyInput('email');
    }
}
