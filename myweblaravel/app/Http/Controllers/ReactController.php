<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Payment;
use App\Models\Customers;
use Illuminate\Support\Facades\Redirect;
use App\Models\color;
use App\Models\ordernumber;
use App\Models\size;
use App\Models\Discounts;
use App\Models\User;
use App\Models\product_colors;
use App\Models\product_sizes;
use Illuminate\Support\Str;
use App\Models\product_variants;
use App\Models\ProductVariant;
use App\Models\Vouchers;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderItems;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use Illuminate\Http\Request;

class ReactController extends Controller
{
    //
    public function index()
    {
        $newproducts = DB::table('products')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.is_new',
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
                'products.price',
                'products.is_new',
                'discounts.quantity',
                'discounts.discount',
                'discounts.status'

            )
            ->join('product_cates', 'products.cate_id', '=', 'product_cates.id')
            ->get();
        return response()->json([
            ['products' => $newproducts]
        ]);
    }
}
