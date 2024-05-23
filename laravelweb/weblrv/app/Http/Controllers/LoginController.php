<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{

    //
    public function login(Request $request){
        if(Auth::id() > 0 ){
            return redirect()->intended('dashboard');
        }
        return view('auth.login');
    }
    
    //
    public function index(Request $request)
    {
        $validation = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                Session::put('authenticated', true);
                return redirect()->intended('dashboard')->with('success', 'Logged in successfully!');
            } else {
                return back()->withInput()->with('error', 'Incorrect password!');
            }
        } else {
            return back()->withInput()->with('error', 'User does not exist!');
        }
    }

    //
    public function logout(Request $request){
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken(); 
        return view('auth.login')->with('success', 'Logged out successfully!'); 
    }

    //
    

}
