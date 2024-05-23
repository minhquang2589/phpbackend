<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {

        $cart = $request->session()->get('cart') ? $request->session()->get('cart') : [];
        //
        $IDs = [];
        if ($cart && is_array($cart)) {
            foreach ($cart as $key => $value) {
                if (isset($value['id'])) {
                    $IDs[] = $value['id'];
                }
            }
        }
        $ListProductCart = DB::table('product')->whereIn('id', $IDs)->get();
        //
        $TotalPrice = 0;
        foreach ($ListProductCart as $value)
        {
            $TotalPrice += $value->Price * $cart[$value->id]['qty'];
        }
        //
        $data = array(
            'cart' => $cart,
            'ListProductCart' => $ListProductCart,
            'TotalPrice' => $TotalPrice
        );
        //
       return view('checkout', $data);
    }
}
