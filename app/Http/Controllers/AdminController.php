<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use App\Models\Login;
use App\Models\SocialCustomer;
use Illuminate\Support\Facades\Redirect;
use App\Rules\Captcha;
use Socialite;


class AdminController extends Controller
{

    public function authLogin()
    {
        $admin_id = Auth::id();
        if($admin_id)
        {
            return Redirect::to('dashboard');
        }else{
           return Redirect::to('admin')->send();
        }
    }
      
    public function index()
    {
        return view('admin.custom_auth.login_auth');
    }

    public function show_dashboard()
    {
        $this->authLogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request)
    {
       
       $admin_email = $request->admin_email;
       $admin_password = md5($request->admin_password);
       $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
       $login_count = $login->count();
       if($login_count)
       {
        session()->put('admin_name',$login->admin_name);
        session()->put('admin_id',$login->admin_id);
           return Redirect::to('dashboard');
       }else{
        session()->put('message','Mật khẩu or tài khoản sai');
           return Redirect::to('admin');

       }
     
    }
    
    public function logout(Request $request)
    {
        $this->authLogin();
        session()->put('admin_name',null);
        session()->put('admin_id',null);
        return Redirect::to('admin');

    }

    public function login_customer_google()
    {
        return Socialite::driver('google')->redirect();

    }

    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        $auth_User = $this->find_create_customer($users,'google');
        if($auth_User)
        {
            $account_name = Customer::where('customer_id',$auth_User->user)->first();
            session()->put('customer_name',$account_name->customer_name);
            session()->put('customer_id',$account_name->customer_id);
        }
        return redirect('home')->with('message', 'Đăng nhập Google thành công');
      
     }

    public function find_create_customer($users,$provider){
        $auth_User = SocialCustomer::where('provider_user_id', $users->id)->first();
        if($auth_User){
            return $auth_User;
        }
        else
        {
            $customer_new = new SocialCustomer([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider)
            ]);
    
            $customer = Customer::where('customer_email',$users->email)->first();
    
                if(!$customer){
                    $customer = Customer::create([
                        'customer_name' => $users->name,
                        'customer_email' => $users->email,
                        'customer_password' => '',
                        'customer_phone' => ''
                    ]);
                }
                $customer_new->customer()->associate($customer);
                $customer_new->save();
                return $customer_new;
    
        }
    }
    

}
