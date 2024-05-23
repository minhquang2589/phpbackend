<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailViewController extends Controller
{
    public function preview($id)
    {
        // // Lấy đơn hàng
        // $order = Order::find($id);
        // dd($order);
        // // Kiểm tra đơn hàng tồn tại
        // if (!$order) {
        //     return response()->json(['error' => 'Order not found'], 404);
        // }

        // // Lấy chi tiết đơn hàng
        // $orderDetails = OrderDetail::where('order_id', $id)->get();

        // // Trả về view của chi tiết đơn hàng dưới dạng HTML
        // return response()->json(['order' => $order, 'orderDetails' => $orderDetails]);
    }
}

