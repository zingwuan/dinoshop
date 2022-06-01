<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Barryvdh\DomPDF\PDF;

class OrderController extends Controller
{
    public function authLogin()
    {
        $admin_id = session()->get('admin_id');
        if($admin_id)
        {
            Redirect::to('dashboard');
        }else{
           return Redirect::to('admin')->send();
        }
    }

    public function manager_order()
    {
        $this->authLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->orderBy('tbl_order.order_id','desc')->get();
        $manager_order = view('admin.manager_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manager_order',$manager_order);
    }

    public function edit_order()
    {
        $this->authLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')->first();
        $manager_order_by_id = view('admin.edit_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.edit_order',$manager_order_by_id);
    }

    public function print_order($order_id)
    {
        $pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($order_id));
		
		return $pdf->stream();
    }

    public function print_order_convert($order_id)
    {
        return $order_id;

    }
}
