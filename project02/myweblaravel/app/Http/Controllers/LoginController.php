<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class LoginController extends Controller
{

    
    public function login(Request $request)
    {
        if (Auth::id() > 0) {
            return redirect()->route('profile');
        }
        return view('auth.login');
    }

    //
    public function checklogin(Request $request)
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
                if ($user->role === 'admin') {
                    return redirect()->intended('admin')->with('success', 'Logged in successfully!');
                } else {
                    return redirect()->intended('')->with('success', 'Logged in successfully!');
                }
            } else {
                return back()->withInput()->with('error', 'Incorrect password!');
            }
        } else {
            return back()->withInput()->with('error', 'User does not exist!');
        }
    }

    //
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('auth.login')->with('success', 'Logged out successfully!');
    }

    //
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required|min:8',
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'error' => $validator,
    //         ]);
    //     }

    //     $email = $request->email;
    //     $password = $request->password;
    //     $user = User::where('email', $email)->first();
    //     if ($user) {
    //         if (Hash::check($password, $user->password)) {
    //             Auth::login($user);
    //             Session::put('authenticated', true);
    //             if ($user->role === 'admin') {
    //                 return response()->json([
    //                     'success' => true,
    //                     'do-login' => 'Logged in successfully!',
    //                 ]);
    //             } else {
    //                 return redirect()->intended('')->with('success', 'Logged in successfully!');
    //             }
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'error' => 'Incorrect password!',
    //             ]);
    //         }
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'error' => 'User does not exist!',
    //         ]);
    //     }
    // }
}
