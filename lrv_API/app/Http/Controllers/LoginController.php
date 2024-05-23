<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    // GET request để hiển thị biểu mẫu đăng nhập
    public function login()
    {
        return view('Auth.login');
    }

    // POST request để xử lý việc nộp biểu mẫu đăng nhập
    public function auth(Request $request)
    {
        $request->validate([
            "email" => 'required',
            "password" => 'required',
        ]);

        // 
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            $request->session()->put('userLogin', ['email' => $request->email]);
            return redirect()->route('admin.accountsetting');
        } else {
            return back()->with('error', 'Đăng nhập không hợp lệ! Vui lòng thử lại');
        }
    }
}
