<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailControler;

//
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
Route::post('/import-csv',[CategoryProduct::class,'import_csv'] );
Route::post('/export-csv',[CategoryProduct::class,'import_csv'] );


//Product
Route::group(['middleware' => 'auth.roles' ],function(){
    Route::get('/add-product',[ProductController::class,'add_product'] );
    Route::get('/all-product',[ProductController::class,'all_product'] );
});


Route::get('/edit-product/{product_id}',[ProductController::class,'edit_product'] );
Route::get('/delete-product/{product_id}',[ProductController::class,'delete_product'] );
Route::post('/update-product/{product_id}',[ProductController::class,'update_product'] );

Route::get('/unactive-product/{product_id}',[ProductController::class,'unactive_product'] );
Route::get('/active-product/{product_id}',[ProductController::class,'active_product'] );

Route::post('/save-product',[ProductController::class,'save_product'] );



//Send Mail
Route::get('/send-mail',[HomeController::class,'send_mail']);

//Cart
Route::post('/save-cart',[CartController::class,'save_cart']);
Route::get('/show-cart',[CartController::class,'show_cart']);
Route::get('/delete-to-cart/{rowId}',[CartController::class,'delete_to_cart']);
Route::post('/update-cart-quantity',[CartController::class,'update_cart_quantity']);

//Checkout
Route::get('/login-checkout',[CheckoutController::class,'login_checkout']);
Route::get('/logout-checkout',[CheckoutController::class,'logout_checkout']);
Route::post('/add-customer',[CheckoutController::class,'add_customer']);
Route::post('/login-customer',[CheckoutController::class,'login_customer']);
Route::post('/order-place',[CheckoutController::class,'order_place']);
Route::get('/checkout',[CheckoutController::class,'checkout']);
Route::get('/payment-onl',[CheckoutController::class,'payment_onl']);
Route::get('/payment',[CheckoutController::class,'payment']);
Route::post('/save-checkout-customer',[CheckoutController::class,'save_checkout_customer']);

//Admin-Order
Route::get('/manager-order',[OrderController::class,'manager_order']);
Route::get('/edit-order/{orderId}',[OrderController::class,'edit_order']);
Route::get('/delete-order/{orderId}',[OrderController::class,'delete_order']);
Route::get('/print-order/{orderId}',[OrderController::class,'print_order']);

//Authentication-roles
Route::get('/register-auth',[AuthController::class,'register_auth']);
Route::get('/login-auth',[AuthController::class,'login_auth']);
Route::get('/logout-auth',[AuthController::class,'logout_auth']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

//Admin-user
Route::get('/users',[UserController::class,'index']);
Route::get('/add-users',[UserController::class,'add_user']);
Route::post('/assign-roles',[UserController::class,'assign_roles']);
Route::post('store-users',[UserController::class,'store_users']);
Route::get('/delete-user/{admin_id}',[UserController::class,'delete_user']);

//Send Mail
Route::get('/forgot-password',[MailControler::class,'forgot_password']);
Route::post('/send-mail-pass',[MailControler::class,'send_mail_pass']);
Route::get('/update-new-pass',[MailControler::class,'update_new_pass']);
Route::post('/reset-new-pass',[MailControler::class,'reset_new_pass']);

//Login customer google
Route::get('/login-customer-google',[AdminController::class,'login_customer_google']);
Route::get('/admin/google/callback',[AdminController::class,'callback_google']);

//Payment
Route::post('/vnpay-payment',[CheckoutController::class,'vnpay_payment']);
Route::post('/momo-payment',[CheckoutController::class,'momo_payment']);
Route::get('/vnpay-payment',[CheckoutController::class,'vnpay_payment']);
