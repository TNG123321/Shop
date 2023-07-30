<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class CategoryProductController extends Controller
{
    //Start function admin page
    public function AuthLogin(){
        $admin_id =  Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dasboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
        $getAllCategoryProduct = DB::table('category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$getAllCategoryProduct);
        // return view('admin.all_category_product');
        return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }

    public function save_category_product(Request $request){
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        $data['meta_keywords'] = $request->category_product_keywords;

        DB::table('category_product')->insert($data);
        Session::put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id){
        DB::table('category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]); 
        Session::put('message', 'Đổi trạng thái hiển thị danh mục sản phẩm thành công');
        return Redirect::to('all-category-product'); 
    }
    public function active_category_product($category_product_id){
        DB::table('category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]); 
        Session::put('message', 'Đổi trạng thái hiển thị danh mục sản phẩm thành công');
        return Redirect::to('all-category-product'); 
    }

    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $getCategoryProduct = DB::table('category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$getCategoryProduct);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['meta_keywords'] = $request->category_product_keywords;

        DB::table('category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function destroy_category_product($category_product_id){
        DB::table('category_product')->where('category_id',$category_product_id)->delete(); 
        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    //End function admin page

    public function showCategoryHome(Request $request,$category_id){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $category_by_id  = DB::table('product')
        ->join('category_product','product.category_id','=','category_product.category_id')
        ->where('product.category_id',$category_id)
        ->get();

        $category_get_name  = DB::table('category_product')
        ->where('category_product.category_id',$category_id)
        ->limit(1)
        ->get();
        
        foreach($category_get_name as $key => $val){
            $meta_desc=$val->category_desc;
            $meta_keywords=$val->meta_keywords;
            $meta_title=$val->category_name;
            $url_canonical=$request->url();
        }
        return view('pages.category.show_category')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('category_by_id', $category_by_id)
        ->with('category_get_name',$category_get_name)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);

    }

}
