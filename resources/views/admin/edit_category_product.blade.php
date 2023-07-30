@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật danh mục sản phẩm
                        </header>
                        <div class="panel-body">
                            @foreach($edit_category_product as $key=>$edit_value)
                                <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value = "{{$edit_value->category_name}}" name = "category_product_name"class="form-control"  placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style = "resize:none" name = "category_product_desc" cols="30" rows="10"
                                     class="form-control" id="exampleInputPassword1">{{$edit_value->category_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword2">Từ khóa danh mục</label>
                                    <textarea style = "resize:none" name ="category_product_keywords" cols="30" rows="10"
                                     class="form-control" id="exampleInputPassword2">{{$edit_value->meta_keywords}}</textarea>
                                </div>
                                <button type="submit" name="update_category_product" class="btn btn-info " style = "float: right">Update danh mục</button>
                            </form>
                            </div>
                            @endforeach

                        </div>
                    </section>

            </div>
</div>
@endsection