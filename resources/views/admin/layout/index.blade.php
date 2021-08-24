<!DOCTYPE html>
<head>
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> 
addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
</script>
<!-- bootstrap-css -->
<base href="{{asset('')}}">
<link rel="stylesheet" href="admin_asset/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="admin_asset/css/style.css" rel='stylesheet' type='text/css' />
<link href="admin_asset/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<script type="text/javascript" language="javascript" src="admin_asset/ckeditor/ckeditor.js" ></script>
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->

<link href="admin_asset/css/all.min.css" rel="stylesheet"> 
<link rel="stylesheet" href="admin_asset/css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="admin_asset/css/monthly.css">
<link rel="stylesheet" href="admin_asset/css/toastr.min.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="admin_asset/js/jquery2.0.3.min.js"></script>

<script src="admin_asset/js/toastr.min.js"></script>
<script src="admin_asset/js/raphael-min.js"></script>
<script src="admin_asset/js/morris.js"></script>
</head>
<body>
<section id="container">
<!--header start-->

@include('admin.layout.header')
<!--header end-->
<!--sidebar start-->

@include('admin.layout.menu')
<!--sidebar end-->
<!--main content start-->
       
<section id="main-content">
        <section class="wrapper">
        @if(session('thongbaotc'))
          <div class="alert alert-success" id="alert">
            {{session('thongbaotc')}}
          </div>
          @endif
          @if(session('thongbaoloimodal'))
          <div class="alert alert-danger" id="alert">
            {{session('thongbaoloimodal')}}
          </div>
          @endif

          @if(count($errors)>0)
          <div class="alert alert-danger" id="alert">
            @foreach($errors->All() as $err)
            {{$err}}
            @endforeach
          </div>
          @endif
            @yield('content')

        </section>
		

 <!-- footer -->
		  
 @include('admin.layout.footer')
  <!-- / footer -->
  
<!--main content end-->
</section>

<script src="admin_asset/js/bootstrap.js"></script>
<script src="admin_asset/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="admin_asset/js/scripts.js"></script>
<script src="admin_asset/js/jquery.slimscroll.js"></script>
<script src="admin_asset/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="admin_asset/js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	
    @yield('script')
	<!-- //calendar -->
</body>
</html>
