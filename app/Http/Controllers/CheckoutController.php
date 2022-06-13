<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Cart;

class CheckoutController extends Controller
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

    public function order_place(Request $request)
    {
        //insert payment
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Dang cho thanh toan';
        $payment_id = DB::table('tbl_payment')->insertgetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = session()->get('customer_id');
        $order_data['shipping_id'] = session()->get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::subtotal(0);
        $order_data['order_status'] = 'Dang cho xu ly';
        $order_id=DB::table('tbl_order')->insertgetId($order_data);

        //insert order-details
        $content = Cart::content();
        foreach($content as $v_content)
        {
        $order_detail_data['order_id'] = $order_id;
        $order_detail_data['product_id'] = $v_content->id;
        $order_detail_data['product_name'] = $v_content->name;
        $order_detail_data['product_price'] = $v_content->price;
        $order_detail_data['product_sales_quantity'] = $v_content->qty;
        DB::table('tbl_order_details')->insertgetId($order_detail_data);
        }
        if($data['payment_method']==1)
        {
            echo ' Thanh toasn ATM';
        }
        elseif($data['payment_method']==2)
        {
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
             return view('pages.checkout.payment_cash')->with('category',$cate_product);
    
        }
        
    }

    public function vnpay_payment(Request $request)
    {
        $data = $request->all();
        $code_cart = rand(00,9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/checkout";
        $vnp_TmnCode = "8HPXV6LZ";//Mã website tại VNPAY 
        $vnp_HashSecret = "VJPCLQTKIYLKSHLJQUEIAGDOOLKDZISD"; //Chuỗi bí mật
        $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['total_vnpay'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }       
    }

    public function momo_payment(Request $request)
    {

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
 
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $_POST['total_momo'];
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/checkout";
        $ipnUrl = "http://127.0.0.1:8000/checkout";
        $extraData = "";

            $requestId = time() . "";
            $requestType = "payWithATM";
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' =>$extraData,
                'requestType' => $requestType,
                'signature' => $signature);

            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
        
            //Just a example, please check more in there
            // redirect()->to($jsonResult['payUrl']);
            return redirect()->to($jsonResult['payUrl']);
            
              
            
                                
    }


    public function execPostRequest($url, $data)
    {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
    }

}