<?php

namespace App\Http\Controllers;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderManagementController extends Controller
{
    public function index(){
        $ListOrder = DB::table('oder')
            ->join('customer', 'oder.Custome_id', '=', 'customer.id')
            ->select('oder.*', 'customer.Name as customer_name')
            ->get();
        return view('Admin.ordermanagement', ['ListOrder' => $ListOrder]);
    }
    
    
}
