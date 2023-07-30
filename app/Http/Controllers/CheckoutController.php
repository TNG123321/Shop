<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Cart;
use DB;
use Session;
session_start();

class CheckoutController extends Controller
{
    //
    public function AuthLogin(){
        $admin_id =  Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dasboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('order')
        ->join('customer','order.customer_id','=','customer.customer_id')
        ->join('shipping','order.shipping_id','=','shipping.shipping_id')
        ->join('order_details','order.order_id','=','order_details.order_id')
        ->select('order.*','customer.*','shipping.*','order_details.*')->where('order.order_id',$orderId)->first();
        $manager_order_by_id= view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);

    }

    public function login_checkout(){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('category', $cate_product)
        ->with('brand', $brand_product);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name; 
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email; 
        $data['customer_password'] = Hash::make($request->customer_password); 

        $customer_id = DB::table('customer')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect('/checkout');
    }

    public function checkout(){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.checkout')->with('category', $cate_product)
        ->with('brand', $brand_product);

    }
    public function save_checkout_customer(Request $request){
          $data = array();
        $data['shipping_name'] = $request->shipping_name; 
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email; 
        $data['shipping_notes'] = $request->shipping_notes; 
        $data['shipping_address'] = $request->shipping_address; 

        $shipping_id = DB::table('shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        return Redirect('/payment');
    }

    public function payment(){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('category', $cate_product)
        ->with('brand', $brand_product);


    }
    public function logout_checkout(){
        Session::flush();
        return Redirect('/login-checkout');

    }
    public function order_place(Request $request){
        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = "Đang chờ xủ lý";
        $payment_id = DB::table('payment')->insertGetId($data);
        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] ='Đang chờ xử lý';
        $order_id = DB::table('order')->insertGetId($order_data);

         //insert order details
        $content = Cart::content();
        $order_details_data = array();
        foreach($content as $v_content){
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] =$v_content->id ;
            $order_details_data['product_name'] = $v_content->name;
            $order_details_data['product_price'] = $v_content->price;
            $order_details_data['product_sales_quantity'] =$v_content->qty;
            $order_details_id = DB::table('order_details')->insert($order_details_data);
        }
        if($data['payment_method']==1){
            echo 'thanh toan the ATM';
        }elseif($data['payment_method']==2){
            $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id','desc')->get();
            $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
            Cart::destroy();
            return view('pages.checkout.handcash')->with('category', $cate_product)
            ->with('brand', $brand_product);
        }else{
            echo 'the ghi no';
        }

    }

    public function login_customer(Request $request)
    {
        $email = $request->email_accout;
        $password = $request->password_accout;
    
        $result = DB::table('customer')->where('customer_email', $email)->first();
        if ($result && Hash::check($password, $result->customer_password)) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout');
        }
    }

    public function order_manager(Request $request)
    {
        $this->AuthLogin();
        $all_order = DB::table('order')
        ->join('customer','order.customer_id','=','customer.customer_id')
        ->select('order.*','customer.customer_name')
        ->orderby('order.order_id','desc')->get();
        $manager_order= view('admin.manage_order')->with('all_order',$all_order);

        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }

}
