<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Đăng nhập quản trị</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<base href="{{asset('')}}">
<link rel="stylesheet" href="admin_asset/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="admin_asset/css/style.css" rel='stylesheet' type='text/css' />
<link href="admin_asset/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="admin_asset/css/font.css" type="text/css"/>
<link href="admin_asset/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="admin_asset/js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2 style="color:#FFFFFF;">ĐĂNG NHẬP ADMIN</h2>
    <caption>
    @if(session('thongbao'))
          <div class="alert alert-success">
            {{session('thongbao')}}
          </div>
          @endif
          @if(session('thongbaoloi'))
          <div class="alert alert-danger">
            {{session('thongbaoloi')}}
          </div>
          @endif

          @if(count($errors)>0)
            <div class="alert alert-danger">
              @foreach($errors->All() as $err)
              {{$err}}
              @endforeach

            </div>
          @endif
    </caption>
		<form action="{{url('/CheckLoginAdmin')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="email" class="ggg" name="Email" placeholder="Nhập tài khoản" required="">
			<input type="password" class="ggg" name="Password" placeholder="Nhập mật khẩu" required="">
			<span><input type="checkbox" /> Nhớ mật khẩu</span>
				<div class="clearfix"></div>
				<input type="submit" value="Đăng Nhập" name="login">
		</form>
    <p><a href="{{url('/ResetPassword')}}">Quên mật khẩu</a></p>
</div>
</div>
<script src="admin_asset/js/bootstrap.js"></script>
<script src="admin_asset/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="admin_asset/js/scripts.js"></script>
<script src="admin_asset/js/jquery.slimscroll.js"></script>
<script src="admin_asset/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="admin_asset/js/jquery.scrollTo.js"></script>
</body>
</html>
