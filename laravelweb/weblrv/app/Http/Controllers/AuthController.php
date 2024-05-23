<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Exception;


class AuthController extends Controller
{
    //
    public function index (){
        return view('sa.uploadproduct');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function upload(Request $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'product_name' => 'required|string',
                'price' => 'required',
                'discount' => 'required',
                'final_price' => 'required',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'size' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('images', $imageName);
            }
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images'), $imageName);
            $product = new Product();
            $product->name = $request->input('product_name');
            $product->price = $request->input('price');
            $product->discount = $request->input('discount');
            $product->final_price = $request->input('final_price');
            $product->image_link = $imageName;
            $product->save();
            DB::commit();
            return redirect()->back()->with('success', 'Product uploaded successfully!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while uploading the product.');
        }
    }

    
}
