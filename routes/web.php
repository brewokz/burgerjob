<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/search', [HomeController::class, 'search']);

//Login & Logout (->middleware can only be accessed by users with their respective roles)
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//User create for admin
Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('is_admin');
Route::get('/user/create', [UserController::class, 'create'])->middleware('is_admin');
Route::post('/user', [UserController::class, 'store'])->middleware('is_admin');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->middleware('is_admin');
Route::patch('/user/{user}', [UserController::class, 'update'])->middleware('is_admin');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->middleware('is_admin');
Route::get('/user/{user}', [UserController::class, 'show'])->name('profile')->middleware('auth');
//change password from admin
Route::get('/password/{user}/edit', [UserController::class, 'view_change_password'])->middleware('is_admin');
Route::patch('/password/{user}', [UserController::class, 'change_password'])->middleware('is_admin');

//change own password 
Route::get('/user/{user}/edit-password', [UserController::class, 'editPassword'])->name('change_password')->middleware('auth');
Route::patch('/user/{user}/update-password', [UserController::class, 'updatePassword'])->middleware('auth');

//profile edit
Route::get('/profile/{user}/edit', [UserController::class, 'profileEdit'])->middleware('auth');
Route::patch('/profile/{user}', [UserController::class, 'profileUpdate'])->middleware('auth');
Route::get('/profile-password/{user}/edit', [UserController::class, 'profileViewChangePassword'])->middleware('auth');
Route::patch('/profile-password/{user}', [UserController::class, 'profileChangePassword'])->middleware('auth');
//profile photo
Route::post('/profile-photo/{user}', [UserController::class, 'profilePhoto'])->middleware('auth');

//Product
Route::get('/product', [ProductController::class, 'index'])->name('product')->middleware('is_admin');
Route::get('/product/create', [ProductController::class, 'create'])->middleware('is_admin');
Route::post('/product', [ProductController::class, 'store'])->middleware('is_admin');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('detail-product');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->middleware('is_admin');
Route::patch('/product/{product}', [ProductController::class, 'update'])->middleware('is_admin');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->middleware('is_admin');
Route::get('/product/{product}', [ProductController::class, 'show'])->middleware('auth');

//Add to cart
Route::get('/cart', [ProductController::class, 'showCart'])->name('cart');
Route::get('/add-to-cart/{product}', [ProductController::class, 'getAddToCart']);
Route::get('/delete-to-cart/{product}', [ProductController::class, 'deleteToCart']);

//Checkout
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('/print', [OrderController::class, 'print'])->name('print')->middleware('auth');
Route::get('/pdf', [OrderController::class, 'pdf'])->name('pdf')->middleware('auth');

//Report
Route::get('/report', [HomeController::class, 'report'])->name('report')->middleware('is_admin');

//Order
Route::get('/order', [OrderController::class, 'index'])->name('order')->middleware('is_admin');
Route::get('/order/{order}/show', [OrderController::class, 'show'])->name('detail-order')->middleware('is_admin');
