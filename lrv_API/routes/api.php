<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create' , function (Request $request) {
    $token = $request -> user() -> createToken($request -> token_name);
    return ['token' => $token -> plainTextToken ];
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/product' , [ProductController::class ,'index' ]);
});
