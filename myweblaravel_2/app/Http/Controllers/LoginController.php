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
    //
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all(),
            ]);
        }

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                Auth::login($user);
                Session::put('authenticated', true);

                return response()->json([
                    'success' => true,
                    'do-login' => 'Logged in successfully!',
                    'role' => $user->role,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'errors' => ['Incorrect password!'],
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'errors' => ['User does not exist!'],
            ]);
        }
    }

    //
    public function checkAuth()
    {
        try {
            if (Auth::check()) {
                return response()->json([
                    'authenticated' => true,
                    'role' => Auth::user()->role,
                ]);
            } else {
                return response()->json(['authenticated' => false], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    ///
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json([
            'success' => true,
            'do-logout' => 'Logged out successfully!',
        ]);
    }
    ///
    public function user()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return response()->json([
                'name' => $user->name,
                'role' => $user->role,
            ]);
        } else {
            return response()->json(null, 200);
        }
    }
    //
}
