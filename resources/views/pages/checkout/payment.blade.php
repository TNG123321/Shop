@extends('welcome')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

			<div class="review-payment">
				<h2>Xem lại giở hàng:</h2>
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
								</form>

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
	</section>


            <p style="margin: 40px; font-size:20px;">Chọn hình thức thanh toán:</p>

            <form action="{{URL::to('/order-place')}}" method="POST">
                @csrf
            <div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="radio">Thanh toán bằng thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="radio">Nhận tiền mặt</label>
					</span>
					<span>
						<label><input name="payment_option" type="radio" value="3">Thanh toán thẻ ghi nợ</label>
					</span>
                    <input type="submit" class="btn btn-primary" name="send_order_place" value="Đặt hàng">
                </div>
            </form>
		</div>
    
@endsection
