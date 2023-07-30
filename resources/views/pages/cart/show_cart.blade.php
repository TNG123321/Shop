@extends('welcome')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
				$content = Cart::content();
				
				?>
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Hình ảnh</td>
						<td class="name">Tên sản phẩm</td>
						<td class="price">Giá</td>
						<td class="quantity">Số lượng</td>
						<td class="total">Tổng tiền</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
						@foreach($content as $key =>$value_content)
						<tr>
							<td class="cart_product">
								<a href="">
									<img src="{{URL::to('uploads/product/'.$value_content->options->image)}}" alt="">
								</a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$value_content->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($value_content->price).' '.'VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<form action="{{URL::to('/update-cart-quantity')}}" method="post">
									@csrf
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="text" name="quantity_cart" value="{{$value_content->qty}}">
									<input type="hidden" value="{{$value_content->rowId}}" name="rowId_cart" class="form-control">
									<input type="submit" value="Cập nhật" class="btn btn-default btn-sm" name="update_qty">
								</div>
								<form>

							</td>
							<td class="cart_total">
								<p class="cart_total_price"></p>
								<?php
								$subtotal = $value_content->price*$value_content->qty;
								echo number_format($subtotal).' '. 'VNĐ';
								
								?>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$value_content->rowId)}}"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

    <section id="do_action">
		<div class="container">
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng<span>{{number_format(Cart::subtotal()).' '.'VNĐ'}}</span></li>
							<li>Thuế<span>{{number_format(Cart::tax()).' '.'VNĐ'}}</span></li>
							<li>Phí vận chuyển<span>Free</span></li>
							<li>Thành tiền<span>{{number_format(Cart::total()).' '.'VNĐ'}}</span></li>
						</ul>
							<!-- <a class="btn btn-default update" href="">Update</a> -->
							<?php
									$customer_id = Session::get('customer_id');
									if($customer_id !=NULL){
							?>
								<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
							<?php
								}else{

							?>
								<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
							<?php
								}
							?>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection