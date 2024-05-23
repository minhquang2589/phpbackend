<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\TestImage;
use App\Models\size;
use App\Models\Images;
use App\Models\ProductDetails;
use App\Models\ProductCates;
use App\Models\Discounts;
use App\Models\color;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductVariant;
use App\Models\product_variants;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use Exception;

class AuthController extends Controller
{

    public function upload(Request $request)
    {
        // return response()->json([
        //     'success' => true,
        //     'message' => $request -> all(),
        // ]);

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'price' => 'required',
            'gender' => 'required',
            'class' => 'required',
            'colors.*' => 'required',
            'quantities.*' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ], [
            // 'discountnumber.min' => 'Số giảm giá phải lớn hơn hoặc bằng 1.'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->all(),
            ]);
        }
        try {
            DB::beginTransaction();

            $startDatetime = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->input('start_datetime'))));
            $endDatetime = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->input('end_datetime'))));

            $discount = new Discounts();
            $discount->discount = $request->input('discountnumber');
            $discount->quantity = $request->input('discountquantity');
            $discount->remaining = $request->input('discountquantity');
            $discount->status = 'Active';
            $discount->start_datetime = $startDatetime;
            $discount->end_datetime = $endDatetime;
            $discount->save();

            $ProductCates = ProductCates::firstOrCreate([
                'gender' => $request->input('gender'),
                'description' => "For " . $request->input('gender')
            ]);

            $productDetails = new ProductDetails();
            $productDetails->description1 = $request->input('detail1');
            $productDetails->description2 = $request->input('detail2');
            $productDetails->description3 = $request->input('detail3');
            $productDetails->description4 = $request->input('detail4');
            $productDetails->description5 = $request->input('detail5');
            $productDetails->description6 = $request->input('detail6');
            $productDetails->save();

            $product = new Product();
            $product->name = $request->product_name;
            $product->price = $request->price;
            $product->description =  $request->description;
            $product->class =  $request->class;
            $product->cate_id = $ProductCates->id;
            $product->detail_id = $productDetails->id;
            $product->is_new = $request->is_new;
            $product->save();

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $originName = $image->getClientOriginalName();
                    $fileName = pathinfo($originName, PATHINFO_FILENAME);
                    $extension = $image->getClientOriginalExtension();
                    $fileName = $fileName . '_' . time() . '.' . $extension;
                    $image->move(public_path('images'), $fileName);
                    $url = asset('images/' . $fileName);
                    $Images = new Images();
                    $Images->product_id = $product->id;
                    $Images->image = $fileName;
                    $Images->save();
                }
            } else {
                return response()->json([
                    'success' => false,
                    'error' => ['Please enter Images!'],
                ]);
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
            if ($request->has('colors')) {
                $colors = json_decode($request->colors, true);
                foreach ($colors as $colorData) {
                    $colorName = $colorData['name'];
                    $colorModel = Color::firstOrCreate(['color' => $colorName]);
                    $totalQuantity = 0;
                    foreach ($colorData['sizes'] as $sizeData) {
                        $sizeName = $sizeData['name'];
                        $quantity = $sizeData['quantity'];

                        if ($quantity !== null && $quantity > 0) {
                            $totalQuantity += $quantity;
                            $sizeModel = Size::firstOrCreate(['size' => $sizeName]);

                            ProductVariant::create([
                                'product_id' => $product->id,
                                'size_id' => $sizeModel->id,
                                'color_id' => $colorModel->id,
                                'discount_id' => $discount_id,
                                'quantity' => $quantity,
                            ]);
                        }
                    }
                    if ($totalQuantity === 0) {
                        return response()->json([
                            'success' => false,
                            'error' => ['Please enter color and quantity'],
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'success' => false,
                    'error' => ['Please enter color and quantity'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => ['Product uploaded successfully!'],
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'error' => ['An error occurred while uploading the product.'],
            ]);
        }
    }
    ///
    public function uploadFile(Request $request)
    {

        try {
            if ($request->hasFile('upload')) {
                $originName = $request->file('upload')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('upload')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;
                $request->file('upload')->move(public_path('images'), $fileName);
                $url = asset('images/' . $fileName);
                return response()->json([
                    'url' => $url,
                    'uploaded' => 1,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'uploaded' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
