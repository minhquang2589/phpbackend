<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function index()
    {
        // Session::flush(); 
        $total = 0;
        $cart = Session::get('cart');
        $cartQuantity = 0;
        $color = null;
        $size = null;
    
        if ($cart !== null) {
            $cartQuantity = count($cart);
            foreach ($cart as $item) {
                if (is_array($item)) {
                    $total += $item['price'] * $item['quantity'];
                }
            }
        } else {
            $cart = [];
        }
    
        $data = [
            'cart' => $cart,
            'total' => $total,
            'cartQuantity' => $cartQuantity
        ];
    
        return view('layout.cart', $data);
    }

    //
    public function addcart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $size = $request->input('size');
        $color = $request->input('color');
        
        if ($size == 'selectsize' || $color == 'selectcolor') {
            return back()->withInput()->withErrors(['error' => 'Please select size and color.']);
        }        
        
        $cart = session()->get('cart', []);

        $existingCartItem = null;

        foreach ($cart as $key => $item) {
            if ($item['id'] == $productId && $item['size'] == $size && $item['color'] == $color) {
                $existingCartItem = $key;
                break;
            }
        }

        if ($existingCartItem !== null) {
            $cart[$existingCartItem]['quantity']++;
        } else {
            $cart[] = [
                'id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image_link,
                'quantity' => 1,
                'size' => $size, 
                'color' => $color, 
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }


    
    // 
    public function cartremore(Request $request)
    {
        $productId = $request->input('product_id');
        $size = $request->input('size');
        $color = $request->input('color');

        $cart = session()->get('cart', []);
        
        foreach ($cart as $key => $item) {
            if ($item['id'] == $productId && (isset($item['size']) && $item['size'] == $size) && $item['color'] == $color) {
                unset($cart[$key]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product removed from cart successfully.');
            }
        }
        
        return redirect()->back()->with('error', 'Product not found in cart.');
    }


    // 
    public function updateQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $newQuantity = $request->input('quantity');
        $color = $request->input('color');
        $size = $request->input('size');

        $cart = session()->get('cart', []);
        $productUpdated = false; 

        foreach ($cart as $key => $item) {
            if ($item['id'] == $productId && $item['color'] == $color && $item['size'] == $size) {
                $cart[$key]['quantity'] = $newQuantity;
                $productUpdated = true; 
                break; 
            }
        }
        if (!$productUpdated) {
            return response()->json(['success' => false, 'message' => 'Product not found in cart.']);
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }
    //
    public function getCartQuantity()
    {
        $cartQuantity = count(session('cart', []));
        return response()->json(['cartQuantity' => $cartQuantity]);
    }
}

