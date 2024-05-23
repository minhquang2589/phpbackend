<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\product_variants;
use App\Models\image;

use Illuminate\Http\Request;

class TableController extends Controller
{
   //
   public function index()
   {
      $products = Product::with('variants')
         ->orderByDesc('is_new') 
         ->paginate(5);


      function getProductVariants()
      {
         $productVariants = product_variants::with('size', 'color')->get();
         return $productVariants;
      }

      $stock = getProductVariants();
      foreach ($stock as $productVariant) {
         $size = $productVariant->size;
         $color = $productVariant->color;
         $quantity = $productVariant->quantity;
      }

      if ($products->isEmpty()) {
         abort(404, 'Product not found');
      }

      $data = [
         'stock' => $stock,
         'products' => $products,
      ];

      return view('dataview.producttable', $data);
   }
}
