@extends('home.layout.index')

@section('content')
@include('home.layout.menu')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
            <caption>
          @if(session('thongbao'))
          <div class="alert alert-success" id="alert">
            {{session('thongbao')}}
          </div>
          @endif
		  @if(session('thongbaoloi'))
            <div class="alert alert-danger" id="alert">
            	{{session('thongbaoloi')}} <br>
            </div>
            @endif
          @if(count($errors)>0)
            <div class="alert alert-danger" id="alert">
              @foreach($errors->All() as $err)
              {{$err}}
              @endforeach

            </div>
          @endif

        </caption>
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
						<form action="home/checklogin" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="email" name="email" placeholder="Tài khoản" />
							<input type="password" name="password" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ đăng nhập
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
						<div class="text-left" style="margin-top:10px;">
						<a href="{{url('/home/khoiphucmk')}}" style="margin-top:5px;">Quên mật khẩu</a>
						</div>
						
					</div>
					<!--/login form-->
				</div>
				
				<div class="col-sm-1">
					<h2 class="or">hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký</h2>
                        <form action="home/addcustomer" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="text" placeholder="Họ và tên" name="Ten"/>
							<input type="email" placeholder="Địa chỉ email" name="Email"/>
                            <input type="password" placeholder="Mật khẩu" name="Password"/>
                            <input type="password" placeholder="Nhập lại mật khẩu" name="PasswordAgain"/>
                            
                            <input type="text" placeholder="Số điện thoại" name="Phone"/>
                            
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
    </section><!--/form-->
    @endsection
@section('script')
	<script>
		$(document).ready (function(){
			window.setTimeout(function () { 
				$("#alert").alert('close'); 
			}, 7000);  
		});
</script>
@endsection