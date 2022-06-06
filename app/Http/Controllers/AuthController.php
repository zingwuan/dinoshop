<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AuthController extends Controller
{
    public function register_auth()
    {
        return view('admin.custom_auth.register');
    }

    public function register(Request $request)
     {
         $data = $request->all();
         $admin = new Admin();
         $admin->admin_name=$data['admin_name'];
         $admin->admin_phone=$data['admin_phone'];
         $admin->admin_email=$data['admin_email'];
         $admin->admin_password=md5($data['admin_password']);
        $admin->save();
        return redirect('register-auth')->with('message','Đăng ký thành công');
     }

    public function login_auth()
     {
        return view('admin.custom_auth.login_auth');
     }

    public function login(Request $request)
     {
        if(Auth::attempt(['admin_email'=>$request->admin_email,'admin_password'=>$request->admin_password]))
        {
            return redirect('dashboard');
        }else{
            return redirect('login-auth')->with('message','Lỗi đăng nhập');
        }
     
    }

    public function logout_auth()
    {
        Auth::logout();
        return redirect('login-auth')->with('message','Đăng xuất Auth thành công');

    }

}
