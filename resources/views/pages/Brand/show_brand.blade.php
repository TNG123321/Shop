@extends('welcome')
@section('content')
                <div class="features_items"><!--features_items-->
						@foreach($brand_get_name as $key=>$brand_name)
						<h2 class="title text-center">Sản phẩm của thương hiệu: {{$brand_name->brand_name}}</h2>
						@endforeach
						@foreach($brand_by_id as $key=>$product)
					<a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
						<div class="col-sm-4">
							<div class="product-image-wrapper">

								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('uploads/product/'.$product->product_image)}}" alt="" />
											<h2>{{number_format($product->product_price).' '.'VND'}}</h2>
											<p>{{$product->product_desc}}</p>
											<p>{{$product->product_name}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
										</div>
								</div>

								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào mục yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
					</a>
						@endforeach
					</div><!--features_items-->
				</div><!--/recommended_items-->
@endsection