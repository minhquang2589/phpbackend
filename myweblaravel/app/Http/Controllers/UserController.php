<?php

namespace App\Http\Controllers;

use App\Helpers\vnd;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\product_variants;
use App\Models\ProductVariant;
use App\Models\featured_sections;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Support\Facades\View;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function about()
    {
        return view('auth.about');
    }
    //
    public function product()
    {
        $featuredSections = featured_sections::where('status', 1)->orderBy('status', 'desc')->take(3)->get();
        if ($featuredSections->count() < 3) {
            return view('featuredsection.featured');
        }
        //
        $discountProduct = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.image',
            'products.is_new',
            DB::raw('SUM(product_variants.quantity) as total_quantity'),
            'discounts.quantity as discount_quantity',
            'discounts.discount',
            'discounts.status'
        )
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('discounts', 'product_variants.discount_id', '=', 'discounts.id')
            ->where('discounts.quantity', '>', 0)
            ->where('discounts.status', 'Active')
            ->groupBy(
                'products.id',
                'products.name',
                'products.description',
                'products.price',
                'products.image',
                'products.is_new',
                'discounts.quantity',
                'discounts.discount',
                'discounts.status'
            )
            ->orderByDesc('sales_count')
            ->take(8)
            ->get();
        $AndImage = [
            $featuredSections[0],
            $featuredSections[1],
            $featuredSections[2],
        ];
        $dataProduct = [
            'AndImage' => $AndImage,
            'discountProduct' => $discountProduct,
        ];
        return view('auth.product',  $dataProduct);
    }
    ////
    public function getProduct(Request $request)
    {

        $page = $request->input('page');
        $perPage = 36;
        $products = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.image',
            'products.is_new',
            DB::raw('SUM(product_variants.quantity) as total_quantity'),
            'discounts.quantity as discount_quantity',
            'discounts.discount',
            'discounts.status'
        )

            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('discounts', 'product_variants.discount_id', '=', 'discounts.id')
            ->groupBy(
                'products.id',
                'products.name',
                'products.description',
                'products.price',
                'products.image',
                'products.is_new',
                'discounts.quantity',
                'discounts.discount',
                'discounts.status'
            )
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();



        return response()->json([
            'success' => true,
            'products' => $products,
            'page' => $page,
        ]);
    }

    //////

    public function blog()
    {
        return view('auth.blog');
    }
    public function contact()
    {
        return view('layout.contact');
    }
    public function profile()
    {
        // $ProfileUser = Users::
        if (Auth::check()) {
            $ProfileUser = Auth::user();
            $ProfileUser = [
                'name' => $ProfileUser->name,
                'email' => $ProfileUser->email,
                'phone' => $ProfileUser->phone,
                'birthday' => $ProfileUser->birthday,
                'genders' => $ProfileUser->genders,
                'address' => $ProfileUser->address,
            ];
        }
        // dd($ProfileUser);
        return view('auth.profile', ['ProfileUser' => $ProfileUser]);
    }
}
