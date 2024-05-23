<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\productcate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ListProductController extends Controller
{
    
        public function index(Request $request)
    {
        $addcart = $request->input('addcart');
        $cart = $request->session()->get('cart') ? $request->session()->get('cart') : [];

        if ($addcart) {
            if (!empty($cart) && is_array($cart)) {
                $qty = 1;
                if (array_key_exists($addcart, $cart)) {
                    $arraddcart = array(
                        'id' => $addcart,
                        'qty' => $cart[$addcart]['qty'] + 1,
                    );
                    $cart[$addcart] = $arraddcart;
                } else {
                    $arraddcart = [
                        'id' => $addcart,
                        'qty' => 1,
                    ];
                    $cart[$addcart] = $arraddcart;
                }
            }else{
                $cart = array();
                $arraddcart = array(
                    'id' => $addcart,
                    'qty' => 1,
                );
                $cart[$addcart] = $arraddcart;
            }
            $request->session()->put('cart', $cart) ? $request -> session() -> get('cart') : [];
        }
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
        $listproduct = Product::all();
        return view('Admin.listproduct', ['listproduct' => $listproduct, 'cart' => $cart, 'ListProductCart' => $ListProductCart, 'TotalPrice' => $TotalPrice]);
    }

}
