<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountSettingController extends Controller
{
    public function index()
    {
        $user = auth() -> user();
        return view('Admin.accountsetting', ['user' => $user]);
    }
}
