<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Số lượng bản ghi trên mỗi trang, mặc định là 10
        $users = User::paginate($perPage); // Sử dụng phân trang

        return response()->json($users);
    }
}
