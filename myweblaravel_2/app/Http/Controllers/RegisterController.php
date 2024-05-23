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
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\d{10}$/',
            'birthday' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8|same:password',
            'address' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all(),
            ]);
        }
        $fullname = $request->fullname;
        $email = $request->email;
        $phone = $request->phone;
        $birthday = $request->birthday;
        $gender = $request->gender;
        $password = $request->password;
        $confirm_password = $request->confirm_password;
        $address = $request->address;

        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            $data = [
                'email' => $email,
                'message' => ['This email has already been taken. Please use it to login or click forgot password!'],
            ];
            return response()->json([
                'success' => false,
                'existingUser' => $data,
            ]);
        }
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name =  $fullname;
            $user->email =  $email;
            $user->phone = $phone;
            $user->genders = $gender;
            $user->birthday = $birthday;
            $user->password = Hash::make($request->password);
            $user->address = $address;
            $user->save();
            Auth::login($user);
            DB::commit();
            return response()->json([
                'success' => true,
                'register' => ['Your account has been registered successfully! Please log in.'],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'errors' => [$e->getMessage()],
            ]);
        }
    }
}
