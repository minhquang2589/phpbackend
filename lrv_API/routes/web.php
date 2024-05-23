<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountSettingController;
use App\Http\Controllers\RemoveController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeleteProductController;
use App\Http\Controllers\RemoveCHeckController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderManagementController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\UploadProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ListProductController;
use App\Http\Controllers\UpdateProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderDetailViewController;
use PHPUnit\Framework\Attributes\Group;

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/register', [AuthController::class, 'register'])->name('Register');
Route::post('/register', [AuthController::class, 'store'])->name('Register.store');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'auth'])->name('login.store');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

//
Route::middleware('adminlogin')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/token/create', [UserController::class, 'index'])->name('admin.token.create');
        Route::get('/checkorder', [OrderController::class, 'index'])->name('checkorder');
        Route::post('/checkorder', [OrderController::class, 'store'])->name('checkorder.store');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/uploadproduct', [UploadProductController::class, 'index'])->name('admin.uploadproduct');
        Route::get('/accountsetting', [AccountSettingController::class, 'index'])->name('admin.accountsetting');
        Route::get('/ordermanagement', [OrderManagementController::class, 'index'])->name('admin.ordermanagement');
        Route::get('/remove-from-cart/{id}', [RemoveController::class, 'index'])->name('removeFromCart');
        Route::get('/remove-from-cartout/{id}', [RemoveCheckController::class, 'index'])->name('removeFromCartout');
        Route::get('/orderdetail/{id}', [OrderDetailController::class, 'index'])->name('orderdetail');
        Route::get('/create-product', [ProductController::class, 'create'])->name('create-product');
        Route::post('/store-product', [ProductController::class, 'store'])->name('store-product');
        Route::get('/invoice/{id}', [InvoiceController::class, 'generateInvoice'])->name('invoice');
        Route::get('/listproduct', [ListProductController::class, 'index'])->name('listproduct');
        Route::delete('/delete-product/{id}', [DeleteProductController::class, 'delete'])->name('delete-product');
        Route::get('/update-product/{id}', [UpdateProductController::class, 'index'])->name('update-product');
        Route::get('/order/{id}/preview', [OrderDetailViewController::class, 'preview'])->name('orderdetailpreview');

    });
});






