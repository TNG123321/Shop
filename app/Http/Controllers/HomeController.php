<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();
use Mail;

class HomeController extends Controller
{
    //
    public function index(Request $request){
         $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id','desc')->get();
         $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // $getAllProduct = DB::table('product')
        // ->join('category_product','category_product.category_id','=','product.category_id')
        // ->join('brand_product','brand_product.brand_id','=','product.brand_id')
        // ->orderby('product_id','desc')->get();
        $meta_desc="sdsad";
        $meta_keywords="asda";
        $meta_title="adsad";
        $url_canonical=$request->url();

         $all_product = DB::table('product')->where('product_status','0')->orderby('product_id','desc')->limit(4)->get();
        //cach 1
        return view('pages.home')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_product', $all_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);
        //cach 2
        // return view('pages.home')->with(compact('cate_product','brand_product','all_product'));
        
    }

    public function search(Request $request){
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $search_product = DB::table('product')->where('product_name','like','%'.$keywords.'%')->get();
        
        return view('pages.product.search')->with('category', $cate_product)->with('brand', $brand_product)
        ->with('search_product', $search_product);

    }

    // send mail
    public function send_mail(){
        $to_name = "Tung Nguyen";
        $to_email = "nguyentungek533@gmail.com";//send to this email

        $data = array("name"=>"noi dung ten","body"=>"noi dung body"); //body of mail.blade.php
    
        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail nhé');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        return Redirect('/')->with('message','');
    }

}
