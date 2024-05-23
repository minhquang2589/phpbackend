<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\product_variants;
use App\Models\Images;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TableController extends Controller
{
   //
   public function index(Request $request)
   {

      $page = $request->input('page');
      $perPage = 10;
      $query = Product::select(
         'products.id',
         'products.name',
         'products.description',
         'products.price',
         'products.is_new',
         'products.sales_count',
         DB::raw('SUM(product_variants.quantity) as total_quantity'),
         'discounts.quantity as discount_quantity',
         'discounts.discount',
         'discounts.status',
         DB::raw('(SELECT image FROM images WHERE product_id = products.id ORDER BY id LIMIT 1) as image')
      )
         ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
         ->leftJoin('discounts', 'product_variants.discount_id', '=', 'discounts.id')
         ->groupBy(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.is_new',
            'discounts.quantity',
            'discounts.discount',
            'discounts.status',
            'products.sales_count',
            'image'
         )
         ->orderBy('products.sales_count', 'desc');
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
      $products = $query->skip(($page - 1) * $perPage)
         ->take($perPage)
         ->get();
      $hasMore = $products->count() >= $perPage;
      return response()->json([
         'success' => true,
         'stock' => $stock,
         'productViews' => $products,
         'page' => $page,
         'hasMore' => $hasMore,
      ]);
   }
}
