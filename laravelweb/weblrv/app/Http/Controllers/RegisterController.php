<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\d{10}$/',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string|max:255',
        ]);
        try {
            if ($validator->fails()) {
                return redirect()->route('register')->withErrors($validator)->withInput();
            }
            DB::beginTransaction();
            $existingUser = User::where('email', $request->email)->first();
            if ($existingUser) {
                throw new \Exception('This email has already been taken. Please choose another one!');
            }
            $user = new User();
            $user->name = $request->fullname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->address = $request->address;
            $user->save();
            DB::commit();
            return redirect()->route('login')->with('success', 'Your account has been registered successfully! Please log in.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('register')->withErrors([$e->getMessage()])->withInput();
        }
    }
}
