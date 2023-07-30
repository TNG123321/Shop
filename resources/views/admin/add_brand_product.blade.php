@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thương hiệu sản phẩm
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
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" name = "brand_product_name"class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                    <textarea style = "resize:none" name = "brand_product_desc" cols="30" rows="10" class="form-control" id="exampleInputPassword1" placeholder="Nhập mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Trạng thái hiển thị</label>
                                    <select name = "brand_product_status" class="form-control input-lg m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">hiện</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_brand_product" class="btn btn-info " style = "float: right">Thêm thương hiệu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
</div>
@endsection