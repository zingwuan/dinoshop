<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use App\Models\Login;
use App\Models\Social;
use Illuminate\Support\Facades\Redirect;
use App\Rules\Captcha;
use Socialite;

class AdminController extends Controller
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
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->stateless()->user();
        $account = Socialite::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
    if($account)
    {
        $account_name = Login::where('admin_id',$account->user)->first();
        session()->put('admin_name',$account_name->admin_name);
        session()->put('admin_id',$account_name->admin_id);
        return redirect('/dashboard')->with('message','Đăng nhập Admin thành công');
    }else{

        $customer_new = new Social([
            'provider_user_id' => $provider->getId(),
            'provider' => 'facebook'
        ]);
        $orang = Login::where('admin_email',$provider->getEmail())->first();
        if(!$orang)
        {
            $orang = Login::create([
                'admin_name' =>$provider->getName(),
                'admin_email' =>$provider->getEmail(),
                'admin_password'=>'',
                'admin_phone'=>''
            ]);
        }
        $customer_new->login()->associate($orang);
        $customer_new->save();

        $account_name = Login::where('admin_id',$account->user)->first();
        session()->put('admin_name',$account_name->admin_name);
        session()->put('admin_id',$account_name->admin_id);
        return redirect('/dashboard')->with('message','Đăng nhập Admin thành công');
    }
    }
      
    public function login_google(){
        return Socialite::driver('google')->redirect();
    }
    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        $authUser = $this->findOrCreateUser($users,'google');
        if($authUser)
        {
            $account_name = Login::where('admin_id',$authUser->user)->first();
            session()->put('admin_name',$account_name->admin_name);
            session()->put('admin_id',$account_name->admin_id);
        }elseif($customer_new){

            $account_name = Login::where('admin_id',$authUser->user)->first();
            session()->put('admin_name',$account_name->admin_name);
            session()->put('admin_id',$account_name->admin_id);
        }
        
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
      
     }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }else{
            $customer_new = new Social([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);
    
            $orang = Login::where('admin_email',$users->email)->first();
    
                if(!$orang){
                    $orang = Login::create([
                        'admin_name' => $users->name,
                        'admin_email' => $users->email,
                        'admin_password' => '',
                        'admin_phone' => '',
                        'admin_status' => 1
                    ]);
                }
                $customer_new->login()->associate($orang);
                $customer_new->save();
                return $customer_new;
    
            }
        }
      
        


    
    public function index()
    {
        return view('admin_login');
    }
    public function show_dashboard()
    {
        $this->authLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request)
    {
       $data = $request->all();
       $admin_email = $request->admin_email;
       $admin_password = md5($request->admin_password);
       $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
       $login_count = $login->count();
       if($login_count)
       {
        session()->put('admin_name',$login->admin_name);
        session()->put('admin_id',$login->admin_id);
           return Redirect::to('/dashboard');
       }else{
        session()->put('message','Mật khẩu or tài khoản sai');
           return Redirect::to('/admin');

       }
     
    }
    public function logout(Request $request)
    {
        $this->authLogin();
        session()->put('admin_name',null);
        session()->put('admin_id',null);
        return Redirect::to('/admin');

    }

}
