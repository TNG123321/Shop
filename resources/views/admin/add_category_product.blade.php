@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" name = "category_product_name"class="form-control"  placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style = "resize:none" name = "category_product_desc" cols="30" rows="10" class="form-control" id="exampleInputPassword1" placeholder="Nhập mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhập từ khóa mô tả danh mục sản phẩm</label>
                                    <textarea style = "resize:none" name = "category_product_keywords" cols="30" rows="10" class="form-control" id="exampleInputPassword1" placeholder="Nhập từ khóa mô tả sản phẩm"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái hiển thị</label>
                                        <select name = "category_product_status" class="form-control input-lg m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">hiện</option>
                                        </select>
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-info " style = "float: right">Thêm danh mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
</div>
@endsection