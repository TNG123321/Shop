@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                        <div class="panel-body">
                        <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '
                                    <span class = "text-success">'
                                        .$message.
                                    '</span>';
                                    
                                    Session::put('message',null);
                                }
                        ?>
                                <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype = "multipart/form-data">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input data-validation = "length" type="text" name = "product_name"class="form-control" data-validation-length="min5" 
                                    data-validation-error-msg="Vui lòng điền tối thiểu 5 ký tự">
                                </div>
                                <div class="form-group">
                                    <label  for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input data-validation="number" type="text" name = "product_price"class="form-control" data-validation-error-msg="Vui lòng nhập trường này,yêu cầu phải là số!">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name = "product_image"class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ckeditor1">Mô tả sản phẩm</label>
                                    <textarea style = "resize:none" name = "product_desc" cols="30" rows="10" 
                                    class="form-control" id="ckeditor1"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="ckeditor2">Nội dung sản phẩm</label>
                                    <textarea style = "resize:none" name = "product_content" cols="30" rows="10" 
                                    class="form-control" id="ckeditor2"></textarea>
                                </div>

                                <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                                    <select name ="category_id" class="form-control input-lg m-bot15">
                                    @foreach($cate_product as $key=>$cate_value)
                                        <option value="{{$cate_value->category_id}}">{{$cate_value->category_name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                <label for="exampleInputEmail1">Thương hiệu</label>
                                    <select name = "product_brand" class="form-control input-lg m-bot15">
                                    @foreach($brand_product as $key=>$brand_value)
                                        <option value="{{$brand_value->brand_id}}">{{$brand_value->brand_name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                <label for="exampleInputEmail1">Trạng thái hiển thị</label>
                                    <select name = "product_status" class="form-control input-lg m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">hiện</option>
                                    </select>
                                </div>

                                <button type="submit" name="add_product" class="btn btn-info " style = "float: right">Thêm sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
</div>
@endsection