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
				<div class="col-sm-12">
					<div class="signup-form"><!--sign up form-->
						<h2>KHÔI PHỤC MẬT KHẨU</h2>
                        <form action="home/xulyreset" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="email" placeholder="Địa chỉ email" name="Email"/>
							<button type="submit" class="btn btn-default">Khôi phục</button>
						</form>
					</div><!--/sign up form-->
				</div>
                
			</div>
            <div class="text-left" style="margin-top:15px;">
						<a href="{{url('/home/login')}}" style="margin-top:5px;">Đăng nhập</a>
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