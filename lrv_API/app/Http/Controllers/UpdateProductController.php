<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductCate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdateProductController extends Controller
{
    public function index(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'productname' => 'required',
                'brandname' => 'required',
                'price' => 'required|numeric',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $product = Product::find($id);
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found');
            }

            $product->ProductName = $request->productname;
            $product->BrandName = $request->brandname;
            $product->Price = $request->price;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/uploads');
                $product->Image = Storage::url($imagePath);
            }

            $product->save();
            DB::commit();

            return redirect()->route('listproduct')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage());
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while updating the product');
        }
    }
}
