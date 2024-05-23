<?php
namespace App\Http\Controllers;
use App\Models\product;
use App\Models\productcate;
use App\Models\order;
use App\Models\Customer;

use Illuminate\Support\Facades\DB;
use App\Models\orderDetail;
use Illuminate\Http\Request;

class DeleteProductController extends Controller
{
    public function delete($id){
        try {
            DB::beginTransaction();
            OrderDetail::where('Product_id', $id)->delete();
            Product::destroy($id);
            DB::commit();
    
            return redirect()->back()->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
   
   
}

    

