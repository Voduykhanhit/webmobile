@extends('home.layout.index')
	@section('title')
		Trang thanh toán
	@endsection
<script>
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
@php 
				$customer_id = Session::get('customer_id');
				@endphp
				@if($customer_id!=NULL)
				
				
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
				  <li><a href="#">Home</a></li>
							
				  <li class="active">Thanh toán giỏ hảng</li>
				</ol>
			</div><!--/breadcrums-->

			<!--/checkout-options-->
<!--/register-req-->

			@if(Cart::count())
			<form style="width:500px;">
                        <div class="form-group" >
                          <select class="form-control chon TinhThanhPho"  id="TinhThanhPho" name="TinhThanhPho">
                            <option value="0" selected>--Chọn tỉnh thành phố--</option>
                            @foreach($city as $ct)
                            <option value="{{$ct->matp}}">{{$ct->name_city}}</option>
                            @endforeach
                            
                          </select>
                        </div>
                      <div class="form-group">
                        <select class="form-control QuanHuyen chon"  id="QuanHuyen" name="QuanHuyen">
                          <option value="0">--Chọn quận huyện--</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <select class="form-control XaPhuong"  id="XaPhuong" name="XaPhuong">
                       
                          <option value="0">--Chọn xã phường--</option>
                         
                        </select>
                      </div>
                      <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </div>
                 <button type="button" name="ThemPhiVanChuyen" class="btn btn-primary ThemPhiVanChuyen">Tính phí vận chuyển</button>
                </form>
			@endif
				@php
        $getcart = Cart::content();
	
		
		
		
        
        @endphp
			<div class="review-payment">

		
		
				<h2>Xem lại giỏ hàng</h2>
				
			</div>
		@if(Session::get('Cart')==true)
			@php 
			
			$total = 0;
			
			 @endphp
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu text-center">
							<td class="image">Ảnh sản phẩm</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                    @foreach($getcart as $item)
						@php
							$subtotal = $item->qty*$item->price;
							$total+=$subtotal;
						@endphp
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
									 <input class="cart_quantity_input" type="text" onchange="CartGioHang(this.value,'{{$item->rowId}}','{{$item->id}}')"  name="quantity" value="{{$item->qty}}">
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{number_format($subtotal)."đ"}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/home/deletecart/'.$item->id)}}"><i class="fa fa-times"></i></a>
							</td>
							
							
                        </tr>
                        @endforeach
						
						<tr class="text-center">
							<td colspan="2"><a type="button" class="btn btn-primary" href="{{url('/home/trangchu')}}">Tiếp tục mua</a></td>
							<td colspan="2"><a type="button" class="btn btn-primary" href="{{url('/home/deleteAllCart')}}">Xóa hết sản phẩm</a></td>
							<td colspan="2" class="text-left">
							<ul>
							<li>Tổng: <span>{{number_format($total,0,',','.')}}đ</span></li>
							@if(Session::get('fee'))
							
							<li>
							<a class="cart_quantity_delete" href="{{url('/home/delete_fee')}}"><i class="fa fa-times"></i></a>
							Phí vận chuyển: <span >{{number_format(Session::get('fee'),0,',','.')}}đ</span>
							
							@php
							
							$total_after_fee = $total + Session::get('fee'); 
						
							@endphp

							</li>
							@endif
							
								@if(Session::get('fee'))
								<li>Tổng chi phí:
								
									@php
										$total_after = $total_after_fee;
										echo number_format($total_after)."đ";
									@endphp
								
								</li>
								@endif
						

					
						</ul>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			@else
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu text-center">
							<td class="image">Ảnh sản phẩm</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td colspan="5" class="text-center" height="70px"><a href="{{url('/home/trangchu')}}" class="alert alert-danger"> Giỏ hàng của bạn đang trống mời bạn chọn hàng để thêm vào giỏ thanh toán!!!</a></td>
					</tr>
					<tr>
						<td colspan="5"><a type="button" class="btn btn-primary" href="{{url('/home/trangchu')}}">Tiếp tục mua</a></td>
					</tr>
					</tbody>
					</table>
				</div>
			@endif
			@if(Cart::count())
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one">
								<form action="{{url('/home/savecheckout')}}" method="post">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="text" name="TenNguoiNhan" placeholder="Họ và tên *" value="{{old('TenNguoiNhan')}}">
									<input type="text" name="Email" placeholder="Email*" value="{{old('Email')}}">
									<input type="text" name="DiaChi"  id="txtvalue" value="{{old('DiaChi')}}" >
                                    <input type="text" name="SoDienThoai" placeholder="Phone *" value="{{old('SoDienThoai')}}">
									<div class="form-group" >
										<select class="form-control"  name="ThanhToan">
											<option value="0">--Chọn hình thức thanh toán--</option>
											<option value="1">Thanh toán khi nhận hàng</option>
											<option value="2">Thanh toán thẻ ATM</option>
											<option value="3">Thanh toán thẻ ghi nợ</option>
										</select>
									</div>
									<textarea name="GhiChu"  placeholder="Ghi chú đơn hàng của bạn" rows="14">{{old('shipping_notes')}}</textarea>
									  <button type="button" data-toggle="modal" data-target="#ModalAdd" name="sendorder" class="btn btn-primary" style="margin-top:5px;margin-bottom:5px;">Đặt mua</button>
									  <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thông Báo</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Bạn có đồng ý đặt hàng không!!!?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Đồng ý</button>
                                                    <button class="btn btn-danger" data-dismiss="modal">Hủy bỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                              </div>
								</form>
							</div>
						</div>
					</div>			
				</div>
			</div>
			@endif					
		</div>
    </section>
	@else
		<a href="{{url('/home/login')}}"><p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p></a>
	@endif
@endsection

@section('script')
	<script>
	$(document).ready(function(){

		$('.chon').on('change',function(){
        var action = $(this).attr('id');
        var matp = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result = '';
      
        if(action=='TinhThanhPho')
        {
          result = 'QuanHuyen';
        }else{
          result = 'XaPhuong';
        }
        $.ajax({
          url: ('home/selectPVC_home'),
          method: 'POST',
          data: {action:action,matp:matp,_token:_token},
          success:function(data){
            $('#'+result).html(data);
			
          }
        });
    });

	})
	
	
	</script>
	<script>
	$(document).ready(function(){
		$('.ThemPhiVanChuyen').click(function(){
		var matp = $('.TinhThanhPho').val();
		var maqh = $('.QuanHuyen').val();
		var xaid = $('.XaPhuong').val();
        var _token = $('input[name="_token"]').val();
		if(matp =='' && maqh=='' && xaid=='')
		{
			alert('Bạn chưa chọn Thành phố và quận huyện');
		}else{
			$.ajax({
          url: ('home/tinhPVC'),
          method: 'POST',
          data: {matp:matp,maqh:maqh,xaid:xaid,_token:_token},
          success:function(data){
			location.reload();
          }
        });
		}
        
		});
	})
	
	</script>
	<script>
$(document).ready (function(){
    window.setTimeout(function () { 
         $("#alert").alert('close'); 
      }, 2000);  
});
</script>
@endsection

