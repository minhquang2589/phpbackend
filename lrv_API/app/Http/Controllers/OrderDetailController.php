<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\order;

use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    //
    public function index($id) {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('homepage')->with('error', 'Order not found');
        }
    
        $customer = DB::table('customer')->where('id', $order->Custome_id)->first();
    
        if (!$customer) {
            return redirect()->route('homepage')->with('error', 'Customer not found');
        }
        $listorderdetail = DB::table('oder_detail') 

            ->join('product', 'oder_detail.Product_id', '=', 'product.id')
            ->select('oder_detail.*', 'product.ProductName as product_name')
            ->where('Oder_id', $id) 
            ->get();
        
        return view('Admin.orderdetail', ['order' => $order, 'customer' => $customer, 'listorderdetail' => $listorderdetail]);
    }
    

}
    
?>

