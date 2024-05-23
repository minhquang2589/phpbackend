<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\productcate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(){}
    public function create()
    {
        $productCategories = productcate::all();
        return view('create-product', ['productCategories' => $productCategories]);
    }
    
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $request->validate([
                'productname' => 'required',
                'brandname' => 'required',
                'price' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
           
            $imagePath = $request->file('image')->store('public/uploads');
            $imageUrl = Storage::url($imagePath);

            $productcate = new ProductCate([
                'Name' => $request->brandname,
            ]);
            $productcate->save();
            $productCateId = $productcate->id;

            $product = Product::create([
                'ProductName' => $request->productname,
                'ProductCateId' => $productCateId,
                'BrandName' => $request->brandname,
                'Price' => $request->price,
                'Image' => $imageUrl, 
            ]);

            if ($product) {
                DB::commit();
                $images = Product::all();
                return redirect()->route('homepage')->with(['images' => $images, 'success' => 'Product created successfully!']);
            } else {
                return Redirect::back()->withErrors(['msg' => 'Product creation failed.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::back()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
