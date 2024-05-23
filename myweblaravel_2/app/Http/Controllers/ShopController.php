<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Illuminate\Database\QueryException;
use App\Models\product_variants;
use App\Models\Size;
use App\Models\Color;
use App\Models\ProductCates;
use App\Models\ProductDetails;
use App\Models\Images;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ShopController extends Controller
{
    public function getBag(Request $request)
    {
        $page = $request->input('page');
        $sale = $request->input('sale');
        $new = $request->input('new');
        $instock = $request->input('instock');
        $outofstock = $request->input('outofstock');
        $priceFrom = $request->input('priceFrom');
        $priceTo = $request->input('priceTo');
        $search = $request->input('search');
        $perPage = 36;
        $query = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.is_new',
            'products.class',
            DB::raw('SUM(product_variants.quantity) as total_quantity'),
            'discounts.quantity as discount_quantity',
            'discounts.discount',
            'discounts.status',
            DB::raw('(SELECT image FROM images WHERE product_id = products.id ORDER BY id LIMIT 1) as image')
        )
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('discounts', 'product_variants.discount_id', '=', 'discounts.id')
            ->where('products.class', '=', 'bag')
            ->groupBy(
                'products.id',
                'products.name',
                'products.description',
                'products.price',
                'products.class',
                'products.is_new',
                'discounts.quantity',
                'discounts.discount',
                'discounts.status'
            );

        if ($sale === "true") {
            $query->where('discounts.status', 'Active')
                ->where('discounts.discount', '>', 0)
                ->where('discounts.quantity', '>', 0);
        }
        if ($new === "true") {
            $query->where('products.is_new', '=', 1);
        }
        if ($instock === "true") {
            $query->havingRaw('total_quantity > 0');
        }
        if ($outofstock === "true") {
            $query->havingRaw('total_quantity = 0');
        }
        if (is_numeric($priceFrom)) {
            $query->where('products.price', '>=', $priceFrom);
        }
        if (is_numeric($priceTo)) {
            $query->where('products.price', '<=', $priceTo);
        }
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('products.description', 'LIKE', '%' . $search . '%');
            });
        }
        $query->orderBy('products.created_at', 'desc');
        $productViews = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();
        $hasMore = $productViews->count() >= $perPage;
        return response()->json([
            'success' => true,
            'productViews' => $productViews,
            'hasMore' => $hasMore,
            'page' => $page,
        ]);
    }
    ///
    public function getHat(Request $request)
    {
        $page = $request->input('page');
        $sale = $request->input('sale');
        $new = $request->input('new');
        $instock = $request->input('instock');
        $outofstock = $request->input('outofstock');
        $priceFrom = $request->input('priceFrom');
        $priceTo = $request->input('priceTo');
        $search = $request->input('search');
        $perPage = 36;
        $query = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.is_new',
            'products.class',
            DB::raw('SUM(product_variants.quantity) as total_quantity'),
            'discounts.quantity as discount_quantity',
            'discounts.discount',
            'discounts.status',
            DB::raw('(SELECT image FROM images WHERE product_id = products.id ORDER BY id LIMIT 1) as image')
        )
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('discounts', 'product_variants.discount_id', '=', 'discounts.id')
            ->where('products.class', '=', 'hat')
            ->groupBy(
                'products.id',
                'products.name',
                'products.description',
                'products.price',
                'products.class',
                'products.is_new',
                'discounts.quantity',
                'discounts.discount',
                'discounts.status'
            );

        if ($sale === "true") {
            $query->where('discounts.status', 'Active')
                ->where('discounts.discount', '>', 0)
                ->where('discounts.quantity', '>', 0);
        }
        if ($new === "true") {
            $query->where('products.is_new', '=', 1);
        }
        if ($instock === "true") {
            $query->havingRaw('total_quantity > 0');
        }
        if ($outofstock === "true") {
            $query->havingRaw('total_quantity = 0');
        }
        if (is_numeric($priceFrom)) {
            $query->where('products.price', '>=', $priceFrom);
        }
        if (is_numeric($priceTo)) {
            $query->where('products.price', '<=', $priceTo);
        }
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('products.description', 'LIKE', '%' . $search . '%');
            });
        }
        $query->orderBy('products.created_at', 'desc');
        $productViews = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();
        $hasMore = $productViews->count() >= $perPage;
        return response()->json([
            'success' => true,
            'productViews' => $productViews,
            'hasMore' => $hasMore,
            'page' => $page,
        ]);
    }
    ///
    public function getShoe(Request $request)
    {
        $page = $request->input('page');
        $sale = $request->input('sale');
        $new = $request->input('new');
        $instock = $request->input('instock');
        $outofstock = $request->input('outofstock');
        $priceFrom = $request->input('priceFrom');
        $priceTo = $request->input('priceTo');
        $search = $request->input('search');
        $perPage = 36;
        $query = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.is_new',
            'products.class',
            DB::raw('SUM(product_variants.quantity) as total_quantity'),
            'discounts.quantity as discount_quantity',
            'discounts.discount',
            'discounts.status',
            DB::raw('(SELECT image FROM images WHERE product_id = products.id ORDER BY id LIMIT 1) as image')
        )
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('discounts', 'product_variants.discount_id', '=', 'discounts.id')
            ->where('products.class', '=', 'shoe')
            ->groupBy(
                'products.id',
                'products.name',
                'products.description',
                'products.price',
                'products.class',
                'products.is_new',
                'discounts.quantity',
                'discounts.discount',
                'discounts.status'
            );

        if ($sale === "true") {
            $query->where('discounts.status', 'Active')
                ->where('discounts.discount', '>', 0)
                ->where('discounts.quantity', '>', 0);
        }
        if ($new === "true") {
            $query->where('products.is_new', '=', 1);
        }
        if ($instock === "true") {
            $query->havingRaw('total_quantity > 0');
        }
        if ($outofstock === "true") {
            $query->havingRaw('total_quantity = 0');
        }
        if (is_numeric($priceFrom)) {
            $query->where('products.price', '>=', $priceFrom);
        }
        if (is_numeric($priceTo)) {
            $query->where('products.price', '<=', $priceTo);
        }
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('products.description', 'LIKE', '%' . $search . '%');
            });
        }
        $query->orderBy('products.created_at', 'desc');
        $productViews = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();
        $hasMore = $productViews->count() >= $perPage;
        return response()->json([
            'success' => true,
            'productViews' => $productViews,
            'hasMore' => $hasMore,
            'page' => $page,
        ]);
    }
    ///
    public function getAccessory(Request $request)
    {
        $page = $request->input('page');
        $sale = $request->input('sale');
        $new = $request->input('new');
        $instock = $request->input('instock');
        $outofstock = $request->input('outofstock');
        $priceFrom = $request->input('priceFrom');
        $priceTo = $request->input('priceTo');
        $search = $request->input('search');
        $perPage = 36;
        $query = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.is_new',
            'products.class',
            DB::raw('SUM(product_variants.quantity) as total_quantity'),
            'discounts.quantity as discount_quantity',
            'discounts.discount',
            'discounts.status',
            DB::raw('(SELECT image FROM images WHERE product_id = products.id ORDER BY id LIMIT 1) as image')
        )
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('discounts', 'product_variants.discount_id', '=', 'discounts.id')
            ->where('products.class', '=', 'accessory')
            ->groupBy(
                'products.id',
                'products.name',
                'products.description',
                'products.price',
                'products.class',
                'products.is_new',
                'discounts.quantity',
                'discounts.discount',
                'discounts.status'
            );

        if ($sale === "true") {
            $query->where('discounts.status', 'Active')
                ->where('discounts.discount', '>', 0)
                ->where('discounts.quantity', '>', 0);
        }
        if ($new === "true") {
            $query->where('products.is_new', '=', 1);
        }
        if ($instock === "true") {
            $query->havingRaw('total_quantity > 0');
        }
        if ($outofstock === "true") {
            $query->havingRaw('total_quantity = 0');
        }
        if (is_numeric($priceFrom)) {
            $query->where('products.price', '>=', $priceFrom);
        }
        if (is_numeric($priceTo)) {
            $query->where('products.price', '<=', $priceTo);
        }
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('products.description', 'LIKE', '%' . $search . '%');
            });
        }
        $query->orderBy('products.created_at', 'desc');
        $productViews = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();
        $hasMore = $productViews->count() >= $perPage;
        return response()->json([
            'success' => true,
            'productViews' => $productViews,
            'hasMore' => $hasMore,
            'page' => $page,
        ]);
    }
    ////
    public function getClothe(Request $request)
    {
        $page = $request->input('page');
        $sale = $request->input('sale');
        $new = $request->input('new');
        $instock = $request->input('instock');
        $outofstock = $request->input('outofstock');
        $priceFrom = $request->input('priceFrom');
        $priceTo = $request->input('priceTo');
        $search = $request->input('search');
        $perPage = 36;
        $query = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.is_new',
            'products.class',
            DB::raw('SUM(product_variants.quantity) as total_quantity'),
            'discounts.quantity as discount_quantity',
            'discounts.discount',
            'discounts.status',
            DB::raw('(SELECT image FROM images WHERE product_id = products.id ORDER BY id LIMIT 1) as image')
        )
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('discounts', 'product_variants.discount_id', '=', 'discounts.id')
            ->where('products.class', '=', 'clothes')
            ->groupBy(
                'products.id',
                'products.name',
                'products.description',
                'products.price',
                'products.class',
                'products.is_new',
                'discounts.quantity',
                'discounts.discount',
                'discounts.status'
            );

        if ($sale === "true") {
            $query->where('discounts.status', 'Active')
                ->where('discounts.discount', '>', 0)
                ->where('discounts.quantity', '>', 0);
        }
        if ($new === "true") {
            $query->where('products.is_new', '=', 1);
        }
        if ($instock === "true") {
            $query->havingRaw('total_quantity > 0');
        }
        if ($outofstock === "true") {
            $query->havingRaw('total_quantity = 0');
        }
        if (is_numeric($priceFrom)) {
            $query->where('products.price', '>=', $priceFrom);
        }
        if (is_numeric($priceTo)) {
            $query->where('products.price', '<=', $priceTo);
        }
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('products.description', 'LIKE', '%' . $search . '%');
            });
        }
        $query->orderBy('products.created_at', 'desc');
        $productViews = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();
        $hasMore = $productViews->count() >= $perPage;
        return response()->json([
            'success' => true,
            'productViews' => $productViews,
            'hasMore' => $hasMore,
            'page' => $page,
        ]);
    }
}
