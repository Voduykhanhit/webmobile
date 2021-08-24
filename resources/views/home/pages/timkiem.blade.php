@extends('home.layout.index')
@section('title')
Tìm kiếm sản phẩm
@endsection

@section('content')
@include('home.layout.menu')
<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
                        <h2 class="title text-center">{{$tukhoa}}</h2>
                        @foreach($productsearch as $sp)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="sanphaminfo text-center">
											<img src="upload/sanpham/{{$sp->product_image}}" alt="" />
											<h2>{{number_format($sp->product_price)." ".'đ'}}</h2>
											<p>{{$sp->product_name}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>{{number_format($sp->product_price).'đ'}}</h2>
												<p>{{$sp->product_name}}</p>
												<p><a href="home/chitiet/{{$sp->product_id}}">Chi tiết sản phẩm</a></p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
							
                        </div>
                        @endforeach
						
						
					
					</div><!--features_items-->
					
					
					<div class="text-center">
								{{--{{$productsearch->link()}}--}}
								{{$productsearch->appends(Request::all())->links()}}
							</div>
				
					</div><!--/recommended_items-->
					
                </div>
@endsection