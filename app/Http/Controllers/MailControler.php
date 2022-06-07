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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Customer;

use Carbon\Carbon;

class MailControler extends Controller
{
    public function forgot_password()
    {
        return view('pages.checkout.forgot_password');

    }

    public function send_mail_pass(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now()->format('d-m-y');
        $title_mail = "Lấy lại mật khẩu".' '.$now;
        $customer = Customer::where('customer_email','=',$data['email_account'])->get();
        foreach($customer as $key => $value)
        {
            $customer_id = $value->customer_id;
        }
        if($customer)
        {
            $count_customer = $customer->count();
            if($count_customer==0)
            {
                return redirect()->back()->with('error','Email chưa được đăng ký');

            }else{
                $token_random = Str::random();
                $customer = Customer::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();

                $to_email = $data['email_account'];
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data= array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$data['email_account']);

                Mail::send('pages.checkout.forget_pass_notify',['data'=>$data],function($message)use($title_mail,$data)
                {
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'],$title_mail);

                });
                return redirect()->back()->with('message','Gửi mail thành công , vui lòng kiểm tra lại email để reset password');
            }
        }


    }
    
    public function update_new_pass()
    {
        return view('pages.checkout.new_pass');
    }

    public function reset_new_pass(Request $request)
    {
        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email','=',$data['email'])->where('customer_token','=',$data['token'])->get();
        $count = $customer->count();
        if($count>0)
        {
            foreach($customer as $key => $cus)
            {
                $customer_id = $cus->customer_id;
            }
            $reset = Customer::find($customer_id);
            $reset ->customer_password = md5($data['password_account']);
            $reset->customer_token=$token_random;
            $reset->save();
            return redirect('home')->with('message','Mật khẩu cập nhật thành công');
        }else{
            return redirect('forgot-password')->with('error','Vui lòng nhập lại Email');
        }
    }
}
