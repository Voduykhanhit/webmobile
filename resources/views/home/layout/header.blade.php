<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 085.925.8045</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i>voduykhanh03092016@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{url('/home/trangchu')}}" ><img src="upload/slide/youtube_profile_image.png" style="width:100px;"></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									Quốc gia
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Việt Nam</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									Money
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">VNĐ</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								@php
									$customer_id = Session::get('customer_id');
								 @endphp
								 @if($customer_id!=NULL)
								<li class="dropdown"><a href="{{url('/home/taikhoanKH/'.$customer_id)}}"><i class="fa fa-user"></i>{{Session::get('customer_name')}}</a>
								<ul role="menu"  class="sub-menu">
                                        <li><a href="{{url('/home/donhang/'.$customer_id)}}" style="background:#696763;" >Đơn hàng của tôi</a></li>
										<li><a href="{{url('/home/taikhoanKH/'.$customer_id)}}" style="background:#696763;" >Thông tin cá nhân</a></li>
                                    </ul>
								</li>
								
								@endif

								
								
								@php 
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
								@endphp
								@if($customer_id!=NULL)
										<li><a href="home/checkout"><i class="fa fa-crosshairs"></i>Đơn hàng</a></li>
									@else
										<li><a href="home/login"><i class="fa fa-crosshairs"></i>Đơn hàng</a></li>
								@endif
										<li><a href="home/showcart"><i class="fa fa-shopping-cart"></i>Giỏ hàng <span class="badge badge-primary">{{Cart::count() ?? 0}}</span></a></li>
								
								@php
									$customer_id = Session::get('customer_id');
								@endphp
									@if($customer_id!=NULL)
										<li><a href="home/logout"><i class="fa fa-lock"></i> Đăng xuất</a></li>
									@else
										<li><a href="home/login"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								@endif
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="home/trangchu" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Shop Mobile<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="home/trangchu">Sản phẩm</a></li> 
										<li><a href="home/checkout">Đơn hàng</a></li> 
										<li><a href="home/showcart">Giỏ hàng</a></li> 
										<li><a href="home/login">Đăng nhập</a></li> 
                                    </ul>
                                </li> 
								<li><a href="home/contact">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
						<form action="home/timkiem" class="form-inline" method="get">
						<div class="form-group">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="text" class="form-control" name="tukhoa" placeholder="Nhập sản phẩm"/>
							</div>
							<button type="submit" style="margin-top:0px;" class="btn btn-primary mt-0">Tìm kiếm</button>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header>