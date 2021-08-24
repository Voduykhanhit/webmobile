<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <base href="{{asset('')}}">
    <link href="home_asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="home_asset/css/font-awesome.min.css" rel="stylesheet">
    <link href="home_asset/css/prettyPhoto.css" rel="stylesheet">
    <link href="home_asset/css/price-range.css" rel="stylesheet">
    <link href="home_asset/css/animate.css" rel="stylesheet">
    <link href="{{asset('home_asset/css/main.css')}}" rel="stylesheet">
    <link href="home_asset/css/style.css" rel="stylesheet">
	<link href="home_asset/css/responsive.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="home_asset/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="home_asset/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="home_asset/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="home_asset/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <!--/header-->
    @include('home.layout.header')
    
    @include('home.layout.slide')
	<!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				
			@yield('content')
			</div>
		</div>
	</section>
	@include('home.layout.footer')
	<!--/Footer-->
	

  
    <script src="home_asset/js/jquery.js"></script>
	<script src="home_asset/js/bootstrap.min.js"></script>
	<script src="home_asset/js/jquery.scrollUp.min.js"></script>
	<script src="home_asset/js/price-range.js"></script>
    <script src="home_asset/js/jquery.prettyPhoto.js"></script>
    <script src="home_asset/js/main.js"></script>
    @yield('script')
</body>
</html>