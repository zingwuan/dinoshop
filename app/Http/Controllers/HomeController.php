<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->get();
        return view('pages.home')->with('category',$cate_product)->with('all_product',$all_product);
    }
    public function send_mail ()
    {
        $to_name = "Nguyen Ha Vu";
        $to_email = "nguyenhavu02@gmail.com";

        $data = array("name"=>"Tài khoản khách hàng","body"=>"Mail gửi về vấn đề hàng hóa");

        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email)
        {
            $message->to($to_email)->subject('Test gửi mail GG');
            $message->from($to_email,$to_name);
        });
         return  redirect('')->with('message','');
    }
}
