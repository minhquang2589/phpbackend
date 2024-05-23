<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\order;
use App\Models\orderDetail;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index(Request $request){
        return ('order');
    }
    public function store(Request $request){
        $cusname = $request -> input('name');
        $cusemail = $request -> input('email');
        $cusaddress = $request -> input('address');
        $cusphone = $request -> input('phone');
        //
        try{
            DB::beginTransaction();
            $data = [
                'Name' => $cusname,
                'Email'=> $cusemail,
                'Phone' => $cusphone,
                'Address' => $cusaddress
            ];
            $customer = Customer::create($data);
            //
            $cart = $request->session()->get('cart') ? $request->session()->get('cart') : [];
            $IDs = [];
            if ($cart && is_array($cart)) {
                foreach ($cart as $key => $value) {
                    if (isset($value['id'])) {
                        $IDs[] = $value['id'];
                    }
                }
            }
            $ListProductCart = DB::table('product')->whereIn('id', $IDs)->get();
            //
            $TotalPrice = 0;
            foreach ($ListProductCart as $value)
            {
                $TotalPrice += $value->Price * $cart[$value->id]['qty'];
            }
            $order_data =[
                'Custome_id' => $customer -> id,
                'Oder_date' => date('Y-m-d H:i:s'),
                'Total_price' => $TotalPrice
            ];
            $order = order::create($order_data);
            //
            foreach ($ListProductCart as $value) {
                $data_order_detail = [
                    'Oder_id' => $order->id,
                    'Product_id' => $value->id,
                    'qty' => $cart[$value->id]['qty'],
                    'Price' => $value->Price,
                ];
            
                $order_detail = OrderDetail::create($data_order_detail);
            }
            DB::commit();
            
        }catch(\Exception $e){
            DB::rollback();
            return redirect()-> route('homepage') -> with('error' , 'Order fail!');
        }
        $request -> session() -> forget('cart');
        return redirect()-> route('homepage') -> with('success' , 'Order Successfully!');
    }
}
