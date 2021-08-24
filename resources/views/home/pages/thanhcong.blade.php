@extends('home.layout.index')
@section('title')
Trang hoàn thành
@endsection
@section('content')
@include('home.layout.menu')
	<div class="col-md-9">
		<div class="text-center">
			<i class="fa fa-check-circle-o" style="font-size:100px;color:green;" aria-hidden="true"></i>
			<div class="tieude-content" >
				<h3 style="font-weight:bold;">ĐẶT HÀNG THÀNH CÔNG</h3>
			</div>
			<p>Cảm ơn bạn đã ủng hộ HTK SHOPMOBILE! đơn hàng của bạn đang được xử lý và sẽ được hoàn thành trong 3-6 giờ.
			Bạn sẽ nhận được Email xác nhận khi đơn đặt hàng của bạn hoàn thành.
			</p>
			<a href="{{url('/home/trangchu')}}" type="button" class="btn btn-primary">Tiếp tục mua hàng</a>
		</div>
	</div>
@endsection
	

	


    