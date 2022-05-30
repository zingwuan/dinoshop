<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;

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
//Frontend
Route::get('/',[HomeController::class,'index'] );
Route::get('/home',[HomeController::class,'index'] );

//Danh muc san pham
Route::get('/category-product/{category_id}',[CategoryProduct::class,'show_category_home'] );
Route::get('/product-details/{product_id}',[ProductController::class,'details_product'] );


//Backend
Route::get('/admin',[AdminController::class,'index'] );
Route::get('/dashboard',[AdminController::class,'show_dashboard'] );
Route::get('/logout',[AdminController::class,'logout'] );
Route::post('/admin-dashboard',[AdminController::class,'dashboard'] );

//Category Product
Route::get('/add-category-product',[CategoryProduct::class,'add_category_product'] );
Route::get('/all-category-product',[CategoryProduct::class,'all_category_product'] );

Route::get('/edit-category-product/{category_product_id}',[CategoryProduct::class,'edit_category_product'] );
Route::get('/delete-category-product/{category_product_id}',[CategoryProduct::class,'delete_category_product'] );
Route::post('/update-category-product/{category_product_id}',[CategoryProduct::class,'update_category_product'] );

Route::get('/unactive-category-product/{category_product_id}',[CategoryProduct::class,'unactive_category_product'] );
Route::get('/active-category-product/{category_product_id}',[CategoryProduct::class,'active_category_product'] );

Route::post('/save-category-product',[CategoryProduct::class,'save_category_product'] );

//Product
Route::get('/add-product',[ProductController::class,'add_product'] );
Route::get('/all-product',[ProductController::class,'all_product'] );

Route::get('/edit-product/{product_id}',[ProductController::class,'edit_product'] );
Route::get('/delete-product/{product_id}',[ProductController::class,'delete_product'] );
Route::post('/update-product/{product_id}',[ProductController::class,'update_product'] );

Route::get('/unactive-product/{product_id}',[ProductController::class,'unactive_product'] );
Route::get('/active-product/{product_id}',[ProductController::class,'active_product'] );

Route::post('/save-product',[ProductController::class,'save_product'] );

//Login Facebook
Route::get('/login-facebook',[AdminController::class,'login_facebook']);
Route::get('/admin/callback',[AdminController::class,'callback_facebook']);

//Login Google
Route::get('/login-google',[AdminController::class,'login_google']);
Route::get('/admin/google/callback',[AdminController::class,'callback_google']);

//Send Mail
Route::get('/send-mail',[HomeController::class,'send_mail']);

//Cart
Route::post('/save-cart',[CartController::class,'save_cart']);
Route::get('/show-cart',[CartController::class,'show_cart']);
Route::get('/delete-to-cart/{rowId}',[CartController::class,'delete_to_cart']);
Route::post('/update-cart-quantity',[CartController::class,'update_cart_quantity']);

//Checkout
Route::get('/login-checkout',[CheckoutController::class,'login_checkout']);
Route::post('/add-customer',[CheckoutController::class,'add_customer']);
Route::get('/checkout',[CheckoutController::class,'checkout']);







