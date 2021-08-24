@extends('home.layout.index')
@section('title')
Trang loại sản phẩm
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
                        <h2 class="title text-center">THƯƠNG HIỆU {{$brand->brand_name}}</h2>
                        @foreach($brand_products as $sp)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
                                <span class="badge" style="background-color:green;">SALE</span>
                                            <div class="sanphaminfo text-center">
                                                <img src="upload/sanpham/{{$sp->product_image}}" alt="" />
                                                <h2>{{number_format($sp->product_price)." ".'đ'}}</h2>
                                                <p>{{$sp->product_name}}</p>
                                                <a href="{{url('/home/addcart/'.$sp->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>{{number_format($sp->product_price).'đ'}}</h2>
                                                    <p>{{$sp->product_name}}</p>
                                                    <p><a style="color:#FFFFFF;" href="{{url('/home/chitiet/'.$sp->product_id)}}">Chi tiết sản phẩm</a></p>
                                                    <a href="{{url('/home/addcart/'.$sp->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                                </div>
                                            </div>
								</div>
                                   
							</div>
                        </div>
                        @endforeach
						
						
						
                    </div>
                    <div class="text-center">
                {{--{{$brand_products->link()}}--}}
                {{$brand_products->appends(Request::all())->links()}}
                </div><!--features_items-->
                </div>
               
                
               
			
@endsection
@section('script')
<script>
$(document).ready (function(){
    window.setTimeout(function () { 
         $("#alert").alert('close'); 
      }, 2000);  
});
</script>
@endsection