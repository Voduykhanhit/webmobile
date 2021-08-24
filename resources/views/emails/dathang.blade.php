<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Đặt hàng thành công - Email</title>
    <style>
        table {
        border-collapse: collapse;
        width: 100%;
        }
        p {
        margin-top: 3px;
        margin-bottom: 3px;
        }
    </style>
</head>
<body>
        <p>Xin chào {{ Session::get('customer_name') }}!</p>
        <p>Cảm ơn bạn đã đặt hàng tại {{'HKT SHOPMOBILE'}}.</p>
        <p>Thông tin giao hàng:</p>
        <p>- Điện thoại: <strong>{{ $order->giaohang->shipping_phone }}</strong></p>
        <p>- Địa chỉ giao: <strong>{{ $order->giaohang->shipping_address }}</strong></p>
        <p>Thông tin đơn hàng bao gồm:</p>
        <table border="1">
        <thead>
          <tr>
            <th class="text-center">Mã hóa đơn</th>
            <th class="text-center">Tên sản phẩm</th>
            <th class="text-center">Giá</th>
            <th class="text-center">Số lượng</th>
            <th class="text-center">Tổng tiền</th>

          </tr>
          
        </thead>
        <tbody>
        @php $total=0; @endphp
        @foreach($getcart as $item)
						@php
							$subtotal = $item->qty*$item->price;
							$total+=$subtotal;
						@endphp
						<tr class="text-center">
              <td>{{$order->order_code}}</td>
							<td class="cart_description">
								<h4><a href="">{{$item->name}}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{number_format($item->price)."đ"}}</p>
							</td>
							
							<td class="cart_quantity">
                {{$item->qty}}
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{number_format($subtotal)."đ"}}</p>
							</td>
              </tr>
              @endforeach
						
              <tr class="text-center">
							<td colspan="6" class="text-left">
									<ul>
								@if(Session::get('fee'))
									
									<li>
									<a class="cart_quantity_delete" href="{{url('/home/delete_fee')}}"><i class="fa fa-times"></i></a>
									Phí vận chuyển: <span >{{number_format(Session::get('fee'),0,',','.')}}đ</span>
									
									@php
									
									$total_after_fee = $total + Session::get('fee'); 
								
									@endphp

									</li>
									@endif
									<li>Tổng: <span>{{number_format($total,0,',','.')}}đ</span></li>
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
        <p>Trân trọng,</p>
        <p>{{'HKT SHOPMOBILE'}}</p>
</body>
</html>