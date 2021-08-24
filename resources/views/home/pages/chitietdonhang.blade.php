@extends('home.layout.index')

@section('title')
    Chi tiết đơn hàng của tôi
@endsection
@section('content')
@include('home.layout.menu')
<div class="col-sm-9 padding-right">
<section id="cart_items">
              <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
							
				  <li class="active">THÔNG TIN KHÁCH HÀNG</li>
				</ol>
			</div>
            <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                        <thead>
                                            <tr class="cart_menu text-center">
                                                <td class="description">Tên khách hàng</td>
                                                <td class="price">Số điện thoại</td>
                                                <td>Email</td>
                                                <td>Hình thức thanh toán</td>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                               
                                                <tr class="text-center">
                                                    <td>{{$khachhang->customer_name}}</td>
                                                    <td>{{$khachhang->customer_phone}}</td>
                                                    <td>{{$khachhang->customer_email}}</td>
                                                    <td>@if($payment->payment_method==1)
                                                            {{'Thanh toán nhận hàng'}}
                                                        @elseif($payment->payment_method==2)
                                                            {{'Thanh toán bằng thẻ ATM'}}
                                                        @else
                                                            {{'Thanh toán thẻ ghi nợ'}}
                                                        @endif
                                                    </td>
                                                </tr>
                                                      
                                        </tbody>
                                </table>
            </div>
            <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
							
				  <li class="active">THÔNG TIN VẬN CHUYỂN</li>
				</ol>
			</div>
            <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                        <thead>
                                            <tr class="cart_menu text-center">
                                                <td class="image">Tên người nhận</td>
                                                <td class="description">Số điện thoại</td>
                                                <td class="price">Địa chỉ</td>
                                                <td>Ghi chú</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <tr class="text-center">
                                                <td>{{$shipping->shipping_name}}</td>
                                                <td>{{$shipping->shipping_phone}}</td>
                                                <td>{{$shipping->shipping_address}}</td>
                                                <td>{{$shipping->shipping_notes}}</td>
                                           </tr>
                                        </tbody>
                                </table>
            </div>
            <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
							
				  <li class="active">SẢN PHẨM MUA</li>
				</ol>
			</div>
            <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                        <thead>
                                            <tr class="cart_menu text-center">
                                                <td class="image">Tên sản phẩm</td>
                                                <td class="description">Giá</td>
                                                <td>Phí giao hàng</td>
                                                <td>Số lượng</td>
                                                <td>Tổng tiền</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php 
                                            $tong=0;
                                        @endphp
                                        @foreach($chitiethoadon as $ct)
                                            @php 
                                                    $subtotal = $ct->product_price*$ct->product_sales_quantity;
                                                    $tong+=$subtotal;
                                            @endphp
                                            <tr data-expanded="true" class="text-center">
                                                    <td>{{$ct->product_name}}</td>
                                                    <td>{{number_format($ct->product_price)."đ"}}</td>
                                                    <td>{{number_format($ct->product_feeship)}}đ</td>
                                                    <td>{{$ct->product_sales_quantity}}</td>
                                                    <td>{{number_format($subtotal)."đ"}}</td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                    <td colspan="4" style="color:red;">
                                                        Phí ship: {{number_format($ct->product_feeship)}}đ <br>
                                                        Tổng thanh toán: {{number_format($tong+$ct->product_feeship)}}đ 
                                                    </td>
                                                   @if($donhang->order_status<=2)
                                                        <td>
                                                            <a class="btn btn-primary" target="_blank" href="{{url('/home/huydonhang/'.$ct->order_code.'/id/'.$khachhang->customer_id)}}">Hủy đơn hàng</a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a class="btn btn-primary" target="_blank" disabled href="{{url('/home/huydonhang/'.$ct->order_code.'/id/'.$khachhang->customer_id)}}">Hủy đơn hàng</a>
                                                        </td>
                                                    @endif

                                            </tr>
                                        </tbody>
                                </table>
            </div>
    </section>

</div>
@endsection
