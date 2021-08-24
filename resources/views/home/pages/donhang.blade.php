@extends('home.layout.index')

@section('title')
    Đơn hàng của tôi
@endsection
@section('content')
@include('home.layout.menu')
<div class="col-sm-9 padding-right">
<caption>
              @if(session('thongbao'))
                  <div class="alert alert-success" id="alert">
                       {{session('thongbao')}}
                  </div>
              @endif

              @if(count($errors)>0)
                  <div class="alert alert-danger" id="alert">
                        @foreach($errors->All() as $err)
                        {{$err}}
                        @endforeach
                  </div>
              @endif

        </caption>
<section id="cart_items">
              <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
							
				  <li class="active">Đơn hàng của bạn</li>
				</ol>
			</div>
            <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                        <thead>
                                            <tr class="cart_menu text-center">
                                                <td class="image">Mã đơn hàng</td>
                                                <td class="description">Ngày đặt hàng</td>
                                                <td class="price">Tổng tiền</td>
                                                <td>Tình trạng</td>
                                                <td class="quantity">Hoạt động</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($donhang as $dh)
                                                <tr class="text-center">
                                                        <td class="donhang_title">#{{$dh->order_code}}</td>
                                                        <td class="donhang_title">{{($dh->created_at)->format('d/m/Y H:i:s')}}</td>
                                                        <td class="donhang_title">{{$dh->order_total}} VNĐ</td>
                                                        <td class="donhang_title">
                                            @if($dh->order_status==1)
                                                 Đơn hàng mới
                                            @elseif($dh->order_status==2)
                                                Đang xác nhận
                                            @elseif($dh->order_status==3)
                                                Đã hủy
                                            @elseif($dh->order_status==4)
                                                Đóng gói sản phẩm
                                            @elseif($dh->order_status==5)
                                                Chờ nhận hàng
                                            @elseif($dh->order_status==6)
                                                Đang chuyển
                                            @elseif($dh->order_status==7)
                                                Thất bại
                                            @elseif($dh->order_status==8)
                                                Đang chuyển hoàn
                                            @elseif($dh->order_status==9)
                                                Đã chuyển hoàn
                                            @elseif($dh->order_status==10)
                                                Thành công
                                    @endif
                                                        </td>
                                                        <td><a href="{{url('/home/chitietdonhang/'.$dh->order_code)}}"><i class="fa fa-eye" aria-hidden="true"></i>Xem chi tiết</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
            </div>
    </div>

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