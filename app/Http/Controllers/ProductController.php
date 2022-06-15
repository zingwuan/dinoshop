<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\CheckoutController;

class ProductController extends Controller
{
    public function authLogin()
    {
        $admin_id = Auth::id();
        if($admin_id)
        {
            Redirect::to('dashboard');
        }else{
           return Redirect::to('admin')->send();
        }
    }
    
    public function add_product()
    {
        $this->authLogin();
       $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product);
    }

    public function all_product()
    {
        $this->authLogin();
        $all_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->orderBy('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }

    public function save_product(Request $request)
    {
        $this->authLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_image;
        $get_image = $request->file('product_image');

        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalExtension();
            $new_image = $get_name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/product',$new_image);
            $data['product_image']= $new_image;
            DB::table('tbl_product')->insert($data);
            session()->put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['product_image']= '';
        DB::table('tbl_product')->insert($data);
        session()->put('message','Thêm sản phẩm thành công');
        return Redirect::to('add-product');
    }

    public function unactive_product($product_id)
    {
        $this->authLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        session()->put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function active_product($product_id)
    {
        $this->authLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        session()->put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id)
    {
        $this->authLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }

    public function update_product(Request $request ,$product_id)
    {
        $this->authLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalExtension();
            $new_image = $get_name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/product',$new_image);
            $data['product_image']= $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            session()->put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        session()->put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');

    }

    public function delete_product($product_id)
    {
        $this->authLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        session()->put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //End Admin
    public function details_product($product_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_product.product_id',$product_id)->get();
         
        foreach($details_product as $key => $value){
           $category_id = $value->category_id;
        }
           $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_category_product.category_id',$category_id)->get();
        return view('pages.details.show_details')->with('category',$cate_product)->with('product_details',$details_product)->with('relate',$related_product);
        
    }
}