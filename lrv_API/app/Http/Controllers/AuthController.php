<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register (){
        return view('Auth.register');
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8',
                'matchpassword' => 'required|same:password',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            if ($user) {
                return redirect()->route('login')->with('success', 'User registered successfully.');
            } else {
                return Redirect::back()->withErrors(['msg' => 'User registration failed.']);
            }
                       
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
    //

}
        public function login (){
            return view('login');
        }

}
