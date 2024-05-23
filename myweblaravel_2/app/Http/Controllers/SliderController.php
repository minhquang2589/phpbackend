<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\slider;
use App\Models\Product;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class SliderController extends Controller
{

    // public function sliderEdit(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     try {
    //         DB::beginTransaction();
    //         if ($request->hasFile('image')) {
    //             $image = $request->file('image');
    //             $fileName = time() . '_' . $image->getClientOriginalName();
    //             $image->move(public_path('images'), $fileName);
    //         } else {
    //             return redirect()->back()->with('error', 'Please choose an image to upload.');
    //         }
    //         $slider = new Slider();
    //         $slider->name = $request->input('name');
    //         $slider->image = $fileName;
    //         $slider->status = $request->input('status') === 'on' ? 1 : 0;
    //         $slider->description = $request->input('description') ?? null;
    //         $slider->save();
    //         DB::commit();
    //         return redirect()->back()->with('success', 'slider upload successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->with('error', 'Failed to upload slider.');
    //     }
    // }
    // ///

    // //
    // public function sliderUpload(){
    //     return view ('slider.upload');
    // }
    // public function editView(Request $request)
    // {
    //     $data = $request->all();
    //     $status = isset($data['status']) && $data['status'] === 'on' ? '1' : '0';
    //     $editViewSlider = Slider::find($data['id']);
    //     if ($request->hasFile('imgcontent')) {
    //         $image = $request->file('imgcontent');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('images'), $imageName);
    //         $editViewSlider->image = $imageName;
    //     }
    //     $editViewSlider->name = $data['content'];
    //     $editViewSlider->status = $status;
    //     $editViewSlider->save();
    //     return redirect()->back()->with('success', 'Update Slider successfully!');
    // }
    /////
    public function getSlider()
    {
        $slider = Slider::all();
        return response()->json([
            'success' => true,
            'slider' =>  $slider,
        ]);
    }
    public function getSliderSale()
    {
        $discountProduct = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.is_new',
            'discounts.quantity as discount_quantity',
            'discounts.discount',
            'discounts.status',
            DB::raw('(SELECT image FROM images WHERE product_id = products.id ORDER BY id LIMIT 1) as image')
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
                'products.is_new',
                'discounts.quantity',
                'discounts.discount',
                'discounts.status'
            )
            ->orderByDesc('products.sales_count')
            ->take(8)
            ->get();
        return response()->json([
            'success' => true,
            'sliderSale' =>  $discountProduct,
        ]);
    }
    //



    public function HandleUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->all(),
            ]);
        }
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $fileName);
            } else {
                return response()->json([
                    'success' => true,
                    'error' => ['Please choose an image to upload.']
                ]);
            }
            $slider = new Slider();
            $slider->name = $request->input('name');
            $slider->image = $fileName;
            $slider->status = $request->input('status') === 'on' ? 1 : 0;
            $slider->description = $request->input('description') ?? null;
            $slider->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => ['slider upload successfully!']
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => ['Failed to delete section.']
            ]);
        }
    }
    ////
    public function sliderEditView()
    {
        $slider = slider::all();
        if ($slider) {
            return response()->json([
                'success' => true,
                'dataSlider' => $slider
            ]);
        }
    }
    ////
    public function removeSlider($id)
    {
        try {
            DB::beginTransaction();
            $slider = slider::find($id);
            if (!$slider) {
                return response()->json([
                    'success' => false,
                    'error' => ['Slider not found.']
                ]);
            }
            $slider->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => ['Slider deleted successfully.']
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => ['Failed to delete Slider.']
            ]);
        }
    }
    ///
    public function editSliderView($id)
    {
        $sliderUpdate = Slider::findOrFail($id);
        return response()->json([
            'success' => true,
            'dataSlider' => $sliderUpdate
        ]);
    }
    ///
    public function handleUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->all(),
            ]);
        }
        try {
            DB::beginTransaction();
            $editViewSlider = Slider::find($request->sliderId);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $fileName);

                $editViewSlider->image = $fileName;
            }
            $editViewSlider->name = $request->name;
            $editViewSlider->status = $request->status;
            $editViewSlider->save();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => ['Update Slider successfully!']
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => ['Failed to updated Slider.']
            ]);
        }
    }
}
