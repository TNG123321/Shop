@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
                        </header>
                        <div class="panel-body">
                            @foreach($edit_product as $key=>$edit_value)
                                <div class="position-center">
                                <form role="form" action="{{URL::to('/update-product/'.$edit_value->product_id)}}" enctype = "multipart/form-data" method="post">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" value = "{{$edit_value->product_name}}" name = "product_name"class="form-control"  placeholder="Tên sản phẩm">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" value = "{{$edit_value->product_price}}" name = "product_price"class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('uploads/product/'.$edit_value->product_image)}}" height = "100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style = "resize:none" name = "product_desc" cols="30" rows="10" 
                                    class="form-control" id="exampleInputPassword1">{{$edit_value->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style = "resize:none" name = "product_content" cols="30" rows="10" 
                                    class="form-control" id="exampleInputPassword1">{{$edit_value->product_content}}</textarea>
                                </div>

                                <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                                    <select name ="category_id" class="form-control input-lg m-bot15">
                                    @foreach($cate_product as $key=>$cate_value)
                                        @if($cate_value->category_id == $edit_value->category_id)
                                        <option selected value="{{$cate_value->category_id}}">{{$cate_value->category_name}}</option>
                                        @else
                                        <option value="{{$cate_value->category_id}}">{{$cate_value->category_name}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                <label for="exampleInputEmail1">Thương hiệu</label>
                                    <select name = "product_brand" class="form-control input-lg m-bot15">
                                    @foreach($brand_product as $key=>$brand_value)
                                        @if($brand_value->brand_id == $edit_value->brand_id)
                                        <option selected value="{{$brand_value->brand_id}}">{{$brand_value->brand_name}}</option>
                                        @else
                                        <option value="{{$brand_value->brand_id}}">{{$brand_value->brand_name}}</option>
                                        @endif
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

                                <button type="submit" name="update_product" class="btn btn-info " style = "float: right">Cập nhật sản phẩm</button>
                            </form>
                            </div>
                            @endforeach

                        </div>
                    </section>

            </div>
</div>
@endsection