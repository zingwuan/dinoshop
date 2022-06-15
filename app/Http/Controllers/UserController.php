<?php

namespace App\Http\Controllers;
use App\Models\Roles;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Rules\Captcha;
use Socialite;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('admin.users.all_users')->with(compact('admin'));
    }

    public function add_user()
    {
        return view('admin.users.add_users');
    }

    public function delete_user($admin_id)
    {
        if(Auth::id()==$admin_id)
        {
            return redirect()->back()->with('message','Bạn không được xóa chính mình');
        }
        $admin = Admin::find($admin_id);
        if($admin)
        {
            $admin->roles()->detach();
            $admin->delete();
        }
        return redirect()->back()->with('message','Xóa user thành công');

    }

    public function assign_roles(Request $request){
        if(Auth::id()==$request->admin_id)
        {
            return redirect()->back()->with('message','Bạn không được phân quyền chính mình');
        }

        $user = Admin::where('admin_email',$request['admin_email'])->first();
        $user->roles()->detach();
        
        if($request->user_role){
           $user->roles()->attach(Roles::where('name','user')->first());     
        }
        if($request->admin_role){
           $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        return redirect()->back()->with('message','Cấp quyền thành công');
    }
}