<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\QueryException;


class ProductController extends Controller
{
   public function view($id)
   {
      $product = Product::find($id);
      if (!$product) {
         abort(404, 'Product not found');
      }
      return view('auth.viewproduct', ['product' => $product]);
   }
   // 
   public function product()
   {
      $product = Product::all();
      if (!$product) {
         abort(404, 'Product not found');
      }
      return view('dataview.alltable',['product' => $product]);
   }
   //
   public function removeproduct($id){
      try {
         DB::beginTransaction();
         $product = Product::find($id);
         if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
         }
         $product->delete();
         DB::commit();
         return redirect()->back()->with('success', 'Product deleted successfully.');
      } catch (\Exception $e) {
         DB::rollBack();
         return redirect()->back()->with('error', 'Failed to delete product.');
      }
   }
   //
}