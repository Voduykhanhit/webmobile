@extends('home.layout.index')
@section('title')
Trang chủ
@endsection

@section('content')
@include('home.layout.menu')
<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
								@if(session('thongbaoloi'))
                                    <div class="alert alert-danger" id="alert">
                                          {{session('thongbaoloi')}} <br>
                                    </div>
                               @endif
                        <h2 class="title text-center">Sản phẩm mới</h2>
                        @foreach($productindex as $sp)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
								@if($sp->product_quantity>0)
										<span class="badge" style="background-color:green;">SALE</span>
									@else
										<span class="badge" style="background-color:red;">{{('Hết hàng')}}</span>
								@endif
										<div class="sanphaminfo text-center">
											<img src="upload/sanpham/{{$sp->product_image}}" alt="" />
											<h2>{{number_format($sp->product_price)." ".'đ'}}</h2>
											<p style="font-weight:bold;">{{$sp->product_name}}</p>
											<div class="giakhigiam">
												<del>{{number_format($sp->product_price*1.1)}}đ</del>
											</div>
											<div class="giamgia">
												<span style="color:green;">Giảm giá 10%</span>
												@if($sp->product_quantity <= 0 )
													<span style="color:red;">{{('Hết hàng')}}</span>
												@else
													<span style="color:#a83293;">{{('Còn hàng')}}</span>
												@endif
											</div>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>{{number_format($sp->product_price).'đ'}}</h2>
												<p>{{$sp->product_name}}</p>
												<p><a href="{{url('/home/chitiet/'.$sp->product_id)}}" class="chitietsp">Chi tiết sản phẩm</a></p>
												<a href="{{url('/home/addcart/'.$sp->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
												
											</div>
										</div>
								</div>
							</div>
							
                        </div>
                        @endforeach
						
						
					
					</div>
					
				
					<div class="text-center">
								{{--{{$productindex->link()}}--}}
								{{$productindex->appends(Request::all())->links()}}
							</div>
			
					</div>
					
                </div>
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