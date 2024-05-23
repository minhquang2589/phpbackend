<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function about (){
        return view('auth.about');
    }

    public function product()
    {
        $products = Product::all();
        $data = [
            'products' => $products
        ];
        return view('auth.product', $data);
    }    
    public function blog (){
        return view('auth.blog');
    }
    public function contact (){
        return view('layout.contact');
    }
    public function profile (){
        return view('auth.profile');
    }




}
