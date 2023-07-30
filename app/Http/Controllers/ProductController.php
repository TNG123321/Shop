<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id =  Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dasboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this->AuthLogin();
        $getAllProduct = DB::table('product')
        ->join('category_product','category_product.category_id','=','product.category_id')
        ->join('brand_product','brand_product.brand_id','=','product.brand_id')
        ->orderby('product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$getAllProduct);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }

    public function save_product(Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        
        $get_image = $request->file('product_image');  
        
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image ->move('uploads/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công');

            return Redirect::to('add-product');
        }
            $data['product_image'] = '';
            
            DB::table('product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        
    }
    public function unactive_product($product_id){
        DB::table('product')->where('product_id',$product_id)->update(['product_status'=>1]); 
        Session::put('message', 'Đổi trạng thái hiển thị sản phẩm thành công');
        return Redirect::to('all-product'); 
    }
    public function active_product($product_id){
        DB::table('product')->where('product_id',$product_id)->update(['product_status'=>0]); 
        Session::put('message', 'Đổi trạng thái hiển thị sản phẩm thành công');
        return Redirect::to('all-product'); 
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->orderby('brand_id','desc')->get();
        $getProduct = DB::table('product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')
        ->with('edit_product',$getProduct)
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request,$product_id){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
       
        $get_image = $request->file('product_image');  
         
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image ->move('uploads/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('product')->where('product_id',$product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');
        }
            
        DB::table('product')->where('product_id',$product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function destroy_product($product_id){
        DB::table('product')->where('product_id',$product_id)->delete(); 
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //---End admin controller----------------------------------------------------------------------
    public function detail_product($product_id){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        $details_product = DB::table('product')
        ->join('category_product','category_product.category_id','=','product.category_id')
        ->join('brand_product','brand_product.brand_id','=','product.brand_id')
        ->where('product.product_id',$product_id)->get();
        
        foreach($details_product as $key=>$value){
            $category_id = $value -> category_id;
        }
        $related_product = DB::table('product')
        ->join('category_product','category_product.category_id','=','product.category_id')
        ->join('brand_product','brand_product.brand_id','=','product.brand_id')
        ->where('category_product.category_id',$category_id)
        ->whereNotIn('product.product_id',[$product_id])
        ->get();

        return view('pages.product.show_details')  
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('details_product', $details_product)
        ->with('relate', $related_product);
    }
}
