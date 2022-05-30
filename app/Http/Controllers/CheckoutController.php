<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function login_checkout ()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('category',$cate_product);

    }

    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customer')->insertgetId($data);

        session()->put('customer_id',$customer_id);
        session()->put('customer_name',$request->customer_name);
        return Redirect::to('checkout');


    }

    public function checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        return view('pages.checkout.checkout')->with('category',$cate_product);

    }

    public function save_checkout_customer (Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_note'] = $request->shipping_note;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id = DB::table('tbl_shipping')->insertgetId($data);

        session()->put('shipping_id',$shipping_id);
        return Redirect::to('payment');
    }

    public function payment()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        return view('pages.checkout.payment')->with('category',$cate_product);

        

    }

    public function logout_checkout()
    {
        session()->flush();
        return Redirect::to('login-checkout');

    }

    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($result)
        {
            session()->put('customer_id',$result->customer_id);
            return Redirect::to('checkout');

        }else{
            return Redirect::to('login-checkout');

        }
        
    }

    public function order_place()
    {
        
    }


}
