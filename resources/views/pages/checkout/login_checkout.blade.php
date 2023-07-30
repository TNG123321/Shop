@extends('welcome')
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="{{URL::to('/login-customer')}}" method="post">
							@csrf
							<input type="text" name="email_accout" placeholder="Tài khoản"/>
							<input type="password"name="password_accout" placeholder="Mật khẩu" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ lần đăng nhập
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký</h2>
						<?php
		$message = Session::get('message');
		if($message){
			echo '
			<span class = "text-alert">'
				.$message.
			'</span>';
			
			Session::put('message',null);
		}
	?>
						<form action="{{URL::to('/add-customer')}}" method="post">
							@csrf
							<input name="customer_name" type="text" placeholder="Họ và tên"/>
							<input name="customer_email" type="email" placeholder="địa chỉ email"/>
							<input name="customer_phone" type="text" placeholder="Số điện thoại"/>
							<input name="customer_password" type="password" placeholder="mật khẩu"/>
							<!-- <input name="confirm_password" type="password" placeholder="nhập lại mật khẩu"/> -->
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection
