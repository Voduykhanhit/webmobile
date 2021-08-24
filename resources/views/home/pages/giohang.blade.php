@extends('home.layout.index')
@section('title')
Giỏ hàng

@endsection
<script type="text/javascript">
	function CartGioHang(qty,rowId,id){
			$.get(('home/updateGioHang'),
			{qty:qty,rowId:rowId,id:id},
			function(){
				window.location.reload();
				}
			 )
	}
</script>
@section('content')

	<section id="cart_items">
		<div class="container">
					<div class="row">
											@if(session('thongbaoloi'))
												
												<div class="alert alert-danger" id="alert">
													{{session('thongbaoloi')}} <br>
												</div>
										@endif
										@if(count($errors)>0)
												<div class="alert alert-danger" id="alert">
												<h4>Thông báo</h4>
													@foreach($errors->All() as $err)
														{{$err}} <br>
													@endforeach
												</div>
										@endif	
					</div>
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="home/trangchu">Home</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu text-center">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					
					<tbody>
                        <!--Cart::add(['id' => $product_id, 'name' => $product_cart->product_name, 'quantity' => 1, 'price' => $product_cart->product_price, 'options' => ['img' => $product_cart->product_image]]);-->
                        @foreach($items as $item)
						<tr class="text-center">
							<td class="cart_product ">   
								<a href=""><img width="70px" src="upload/sanpham/{{$item->options->image}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$item->name}}</a></h4>
								
							</td>
							<td class="cart_price">
								<p>{{number_format($item->price)."đ"}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button" style="display:inline-flex;">
									
									<input class="cart_quantity_input" type="text" onchange="CartGioHang(this.value,'{{$item->rowId}}','{{$item->id}}')"  name="quantity" value="{{$item->qty}}" autocomplete="off"  size="2">
									
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{number_format($item->price*$item->qty)."đ"}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="home/deletecart/{{$item->rowId}}"><i class="fa fa-times"></i></a>
							</td>
                        </tr>
                        @endforeach
						<tr class="text-center">
							<td colspan="2"><a type="button" class="btn btn-primary" href="home/trangchu">Tiếp tục mua</a></td>
							<td colspan="2"><a type="button" class="btn btn-primary" href="home/deleteAllCart">Xóa hết sản phẩm</a></td>
							<td colspan="2" class="text-left">
							
							</td>
						</tr>
					</tbody>
				</table>
            </div>
           
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			
			<div class="row">
				<!--<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>-->
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng: <span>{{$total}}đ</span></li>
							<li>Phí vận chuyển: <span>Free</span></li>
							<li>Thành tiền <span>{{$total}}đ</span></li>
						</ul>
						@php
							$customer_id = Session::get('customer_id');
							
							
						@endphp
						@if($customer_id!=NULL)
							<a class="btn btn-default check_out" href="home/checkout">Thanh toán</a>
						@else
							<a class="btn btn-default check_out" href="home/login">Thanh toán</a>
						@endif

							
					</div>
				</div>
			</div>
		</div>
	</section>
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

