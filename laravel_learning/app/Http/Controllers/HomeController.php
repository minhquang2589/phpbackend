<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //


    public function index(){
        $listproduct = product::all();
        return view('homepage', ['listproduct' => $listproduct]);
    }
}
