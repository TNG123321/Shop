@extends('welcome')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="register-req">
				<span>Vui lòng đăng ký hoặc đăng nhập để có thể xem lịch sử mua hàng</span>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-14 clearfix">
						<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one">
								<form action="{{URL::to('/save-checkout-customer')}}" method="post">
									@csrf
									<input type="text" name="shipping_name" placeholder="Họ và tên">
									<input type="text" name="shipping_phone" placeholder="Số điện thoại">
									<input type="text" name="shipping_email" placeholder="email">
									<input type="text" name="shipping_address" placeholder="Địa chỉ">
									<p>Ghi chú khi gửi hàng</p>
									<textarea name="shipping_notes"  placeholder="Lưu ý cho người bán" rows="16"></textarea>
									<button type="submit" class="btn btn-default" name="send_order">Gửi</button>

								</form>
							</div>
						</div>
					</div>				
				</div>
			</div>
			<div class="review-payment">
				<h2>Xem lại giở hàng:</h2>
			</div>

			
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->
    @endsection