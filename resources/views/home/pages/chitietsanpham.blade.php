@extends('home.layout.index')


@section('content')

@include('home.layout.menu')
<div class="col-sm-9 padding-right">
	<div class="product-details"><!--product-details-->

								@if(session('thongbaoloi'))
                                    <div class="alert alert-danger" id="alert">
                                          {{session('thongbaoloi')}} <br>
                                    </div>
                               @endif
						<div class="col-sm-5">
							<div class="view-product">
								<img src="upload/sanpham/{{$productdetail->product_image}}" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->

								    <div class="carousel-inner">
										@php $i=0; @endphp
										@foreach($productimage as $ha)
										<div class="@if($i==0){{'item active text-center'}} @else{{'item text-center'}} @endif">
										@php $i++; @endphp
										  <a href=""><img width="50px" height="100px" src="upload/hinhanhsanpham/{{$ha['image']}}" alt=""></a>
										 
										</div>
										
										
											
										
										@endforeach
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

			</div>
		<div class="col-sm-7">
			<div class="product-information"><!--/product-information-->
				<img src="images/product-details/new.jpg" class="newarrival" alt="" />
				<h2>{{$productdetail->product_name}}</h2>
				<span>
					<span>Giá: {{ number_format($productdetail->product_price).'đ'}}</span>
					<a type="button" href="home/addcart/{{$productdetail->product_id}}" class="btn btn-fefault cart">
						<i class="fa fa-shopping-cart"></i>
						Thêm vào giỏ
</a>
				</span>
				<p><b>Loại sản phẩm: </b> {{ $productdetail->danhmucsanpham->category_name}}</p>
				<p><b>Tình trạng: </b>  
							@if($productdetail->product_quantity>0)
									@php $productdetail->product_status =1; @endphp
										@if($productdetail->product_status==1)
										{{'Còn hàng'}}
										@endif
								@else
								@php $productdetail->product_status = 0; @endphp
										@if($productdetail->product_status==0)
										{{'Hết hàng'}}
										@endif
							@endif
				</p>
                <p><b>Thương hiệu: </b> {{$productdetail->thuonghieu->brand_name}}</p>
			</div><!--/product-information-->
		</div>
	</div><!--/product-details-->
	<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Giới thiệu</a></li>
								<li><a href="#tag" data-toggle="tab">Mô tả</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Bình luận</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class="col-sm-12">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<p>{!!$productdetail->product_desc!!}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
							
							<div class="tab-pane fade" id="tag" >
								<div class="col-sm-12">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<p>{!!$productdetail->product_content!!}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
							<div class="col-sm-12" id="comment">
							@php $stt=0; @endphp
									@foreach($comment as $cm)
									@if($cm->comments_status==1)
									<ul class="mt-5">
										<li><a style="font-weight:bold;" href=""><img src="upload/slide/usercomment.jpg" witdh="50px" height="50px" alt="">{{$cm->comments_name}}</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>{{$cm->created_at}}</a></li>
										
									</ul>
									<p>{{$cm->comments_content}}</p>
									<div class="text-right">
										<button class="btn btn-primary mb-2" type="button" data-toggle="collapse" data-parent="#reviews" data-target="#{{$stt}}" aria-expanded="false" aria-controls="#{{$stt}}">
											Xem câu trả lời
										</button>
									</div>
									<div style="padding-left:70px;" class="collapse" id="{{$stt}}"  data-parent="#reviews">
											@foreach($reply as $rl)
											@if($rl->comments_id == $cm->comments_id)
											
											
											@php $stt++; @endphp
										<ul>
											<li><a style="font-weight:bold;" href=""><img src="upload/slide/usercomment.jpg" witdh="50px" height="50px" alt="">Người kiểm duyệt</a></li>
											<li><a href=""><i class="fa fa-clock-o"></i>{{$rl->created_at}}</a></li>
										</ul>
										<p>{{$rl->reply_content}}</p>
										
										@endif
										@endforeach
										</div>
										
									@endif
									@endforeach
								
							</div>
							<div class="text-right">
							{{$comment->links()}}
							</div>
							
							@php $customer_name = Session::get('customer_name');
								$customer_email = Session::get('customer_email');
							 @endphp
							@if($customer_name && $customer_email)
							<div class="col-sm-12">
									<p><b>Viết bình luận</b></p>
									
									<form action="home/commentsimple/{{$productdetail->product_id}}" method="POST">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<span>
											<input type="hidden" name="Ten" value="{{$customer_name}}" placeholder="Nhập tên"/>
											<input type="hidden" name="Email" value="{{$customer_email}}" placeholder="Nhập Email"/>
										</span>
										<textarea name="NoiDung" ></textarea>
										<button type="submit" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>




							@else
								<div class="col-sm-12">
									<p><b>Viết bình luận</b></p>
									
									<form action="home/commentsimple/{{$productdetail->product_id}}" method="POST">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<span>
											<input type="text" name="Ten" placeholder="Nhập tên"/>
											<input type="email" name="Email" placeholder="Nhập Email"/>
										</span>
										<textarea name="NoiDung" ></textarea>
										<button type="submit" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
								@endif
							</div>
							
						</div>
					</div><!--/category-tab-->
	
	
	<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">SẢN PHẨM GỢI Ý</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								
								
								<div class="item active">	
								@foreach($sanphamdecu as $sp)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="sanphaminfo text-center">
												
													<img src="upload/sanpham/{{$sp->product_image}}" alt="" />
													<h2>Giá: {{number_format($sp->product_price).'đ'}}</h2>
													<p>{{$sp->product_name}}</p>
													<a type="button" href="home/addcart/{{$sp->product_id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
	
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