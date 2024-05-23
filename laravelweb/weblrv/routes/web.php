<?php

use App\Http\Controllers\AdminController;
use Laravel\Folio\Folio;
use Illuminate\Support\Facades\Route;    
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthenMiddleware;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CustomCheckRole;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/cart/quantity', [CartController::class, 'getCartQuantity'])->name('cart.quantity');

Route::get('/homepage', [UserController::class, 'homepage'])->name('homepage'); 
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/forgotpassword', [ForgotPasswordController::class, 'index'])->name('forgotpassword');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::post('/do-login', [LoginController::class, 'index'])->name('admin.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout'); 
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe'); 
Route::post('/add-to-cart', [CartController::class, 'addcart'])->name('addcart');
Route::get('/cart', [CartController::class, 'index'])->name('cart'); 
Route::post('/cart-remove', [CartController::class, 'cartremore'])->name('cart.remove');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
Route::get('/product/{id}', [ProductController::class, 'view'])->name('product.view');
// 
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/home', [UserController::class, 'home'])->name('home');
Route::get('/product', [UserController::class, 'product'])->name('product');
Route::get('/project', [UserController::class, 'project'])->name('project');
Route::get('/blog', [UserController::class, 'blog'])->name('blog');
Route::get('/contact', [UserController::class, 'contact'])->name('contact'); 
//
Route::get('admin/dashboard', [AdminController::class, 'index']) -> middleware(['checkRole']);
//
Route::middleware([AuthenMiddleware::class])->group(function () {
    Route::get('/changepassword', [ChangePasswordController::class, 'index'])->name('changepassword');
    Route::post('/change-password', [ChangePasswordController::class, 'change'])->name('change.password');
    Route::get('/alltable', [TableController::class, 'index'])->name('table');
    Route::get('/usermanagement', [UserManagementController::class, 'index'])->name('usermanagement');
    Route::delete('/usermanagement/delete/{id}', [UserManagementController::class, 'delete'])->name('usermanagement.delete');
    Route::get('/uploadproduct', [AuthController::class, 'index'])->name('uploadproduct');
    Route::post('/uploadproduct', [AuthController::class, 'upload'])->name('uploadproduct');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
    Route::get('/profile', [UserController::class, 'profile'])->name('profile'); 
    Route::post('/uploadproduct', [AuthController::class, 'upload'])->name('upload.product');
    Route::get('/productmanagement', [ProductController::class, 'product'])->name('productmanagement');
    Route::delete('/productmanagement/delete/{id}', [ProductController::class, 'removeproduct'])->name('productmanagement.delete');


});
