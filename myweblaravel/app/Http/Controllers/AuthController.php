<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\size;
use App\Models\Images;
use App\Models\ProductDetails;
use App\Models\ProductCates;
use App\Models\Discounts;
use App\Models\color;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use Exception;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('sa.uploadproduct');
    }
    // //////// //////// / upload product  /////////////// //////// ////////
    public function upload(Request $request)
    {
        dd($request);

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'price' => 'required',
            // 'discountnumber' => 'min:1',
            'gender' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image5' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ], [
            // 'discountnumber.min' => 'Số giảm giá phải lớn hơn hoặc bằng 1.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd($validator);

        $startDatetime = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->input('start_datetime'))));
        $endDatetime = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->input('end_datetime'))));

        try {
            DB::beginTransaction();
            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('images', $imageName);
            }
            $imageName = time() . '.' . $request->file('images')->extension();
            $request->file('images')->move(public_path('images'), $imageName);
            $is_new = $request->has('is_new') ? 1 : 0;

            $discount = new Discounts();
            $discount->discount = $request->input('discountnumber');
            $discount->quantity = $request->input('discountquantity');
            $discount->remaining = $request->input('discountquantity');
            $discount->status = 'Active';
            $discount->start_datetime = $startDatetime;
            $discount->end_datetime = $endDatetime;
            $discount->save();

            $productCates = new ProductCates();
            $productCates->gender = $request->input('gender');
            $productCates->description = "For " . $request->input('gender');
            $productCates->save();

            $productDetails = new ProductDetails();
            $productDetails->description1 = $request->input('detail1');
            $productDetails->description2 = $request->input('detail2');
            $productDetails->description3 = $request->input('detail3');
            $productDetails->description4 = $request->input('detail4');
            $productDetails->description5 = $request->input('detail5');
            $productDetails->description6 = $request->input('detail6');
            $productDetails->save();

            $product = new Product();
            $product->name = $request->input('product_name');
            $product->price = $request->input('price');
            $product->description = $request->input('description');
            $product->cate_id = $productCates->id;
            $product->detail_id = $productDetails->id;
            $product->image = $imageName;
            $product->is_new = $is_new;
            $product->save();

            for ($i = 1; $i <= 5; $i++) {
                if ($request->hasFile("image{$i}")) {
                    $image = $request->file("image{$i}");
                    $imageName = time() . "_{$i}_" . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName);
                    Images::create([
                        'product_id' => $product->id,
                        'image' => $imageName,
                    ]);
                }
            }
            $discountID = $discount->id;
            $discount = Discounts::find($discountID);
            $discount_id = NULL;
            if ($discount) {
                $discountQuantity = $discount->quantity;
                $discountValue = $discount->discount;
                if ($discountQuantity <= 0 || $discountValue <= 0 || $discountQuantity == NULL || $discountValue == NULL) {
                    $discount_id = NULL;
                } else {
                    $discount_id = $discount->id;
                }
            }
            foreach ($request->except('_token', 'product_name', 'price', 'description') as $colorName => $sizes) {
                if (is_array($sizes) && array_filter($sizes)) {
                    $colorModel = Color::firstOrCreate(['color' => $colorName]);
                    foreach ($sizes as $size => $quantity) {
                        if (!empty($quantity)) {
                            $sizeModel = Size::firstOrCreate(['size' => $size]);
                            ProductVariant::updateOrCreate([
                                'product_id' => $product->id,
                                'size_id' => $sizeModel->id,
                                'color_id' => $colorModel->id,
                                'discount_id' =>  $discount_id,
                            ], [
                                'quantity' => $quantity,
                            ]);
                        }
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Product uploaded successfully!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while uploading the product.');
        }
    }
    // //////// //////// / /////////////// //////// ////////

}
