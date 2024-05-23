<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemoveController extends Controller
{
    public function index($id)
{    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
    return redirect()->route('homepage');
}

}
