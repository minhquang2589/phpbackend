<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadProductController extends Controller
{
    //
    public function index(Request $request){
        return view('Admin.uploadproduct');
    }
    
}
