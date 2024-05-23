<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function generateInvoice($id, $download = true)
    {
        $html = $this->print_order_convert($id);
        $pdf = PDF::loadHTML($html);
        if ($download) {
            return $pdf->download('invoice.pdf');
        } else {
            return $pdf->stream('invoice.pdf');
        }
    }
    private function print_order_convert($orderId)
    {
        $order = Order::find($orderId);
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
            ->where('Oder_id',$orderId) 
            ->get();
        //
        $qty = [];
        $name = [];
        foreach ($listorderdetail as $detail) {
            $qty[] = $detail->qty;
            $name[] = $detail->product_name;
        }
        
        $html = '<h1>Order Details</h1>';
        $html .= '<p>Order ID: ' . $order->id . '</p>';
        $html .= '<p>Order Date: ' . $order->Oder_date . '</p>';
        $html .= '<p>Customer Name: ' .$customer->Name . '</p>';
        $html .= '<p>Customer Email: ' .$customer->Email . '</p>';
        $html .= '<p>Customer Phone: ' .$customer->Phone . '</p>';
        $html .= '<p>Customer Address: ' .$customer->Address . '</p>';
        for ($i = 0; $i < count($qty); $i++) {
            $html .= '<p>Order Name: ' . $name[$i].', qty: ' . $qty[$i].'</p>';
        }
        $html .= '<p>Total Price: ' . $order->Total_price . '</p>';

        
        return $html;
    }
}