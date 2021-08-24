@extends('admin.layout.index')
  @section('title')
    Danh sách đơn hàng
  @endsection
@section('content')
<div class="table-agile-info">
      <div class="panel panel-default">
          <div class="panel-heading">
              Thông tin khách hàng
          </div>  
      <div>
          <table class="table" ui-jq="footable" ui-options='{
            "paging": {
              "enabled": true
            },
            "filtering": {
              "enabled": true
            },
            "sorting": {
              "enabled": true
            }}'>
            <caption>
                  @if(session('thongbao'))
                    <div class="alert alert-success">
                          {{session('thongbao')}}
                    </div>
                  @endif

                  @if(count($errors)>0)
                    <div class="alert alert-danger">
                          @foreach($errors->All() as $err)
                          {{$err}}
                          @endforeach
                    </div>
                  @endif

            </caption>
            <thead>
                  <tr>
                    <th class="text-center">Tên khách hàng</th>
                    <th class="text-center">Số điện thoại</th>
                    <th class="text-center" data-breakpoints="xs">Email</th>
                  </tr>
            </thead>
            <tbody>
                  <tr data-expanded="true" class="text-center">
                    <td>{{$khachhang->customer_name}}</td>
                    <td>{{$khachhang->customer_phone}}</td>
                    <td>{{$khachhang->customer_email}}</td>
                  </tr>
            </tbody>
          </table>
    </div>
</div>

    <br>
<div class="table-agile-info">
      <div class="panel panel-default">
          <div class="panel-heading">
              THÔNG TIN VẬN CHUYỂN
          </div>
      <div>
      <table class="table" ui-jq="footable" ui-options='{
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        }}'>
        <caption>
              @if(session('thongbao'))
                  <div class="alert alert-success">
                       {{session('thongbao')}}
                  </div>
              @endif

              @if(count($errors)>0)
                  <div class="alert alert-danger">
                        @foreach($errors->All() as $err)
                        {{$err}}
                        @endforeach
                  </div>
              @endif

        </caption>
        <thead>
          <tr>
            <th class="text-center" data-breakpoints="xs">ID</th>
            <th class="text-center">Tên người nhận</th>
            <th class="text-center">Số điện thoại</th>
            <th class="text-center">Địa chỉ</th>
            <th class="text-center">Ghi chú giao hàng</th>

          </tr>
        </thead>
        <tbody>
          
          <tr data-expanded="true" class="text-center">
            <td>{{$shipping->shipping_id}}</td>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_notes}}</td>
          </tr>
         
        </tbody>
      </table>
    </div>
    </div>
<br>
<div class="table-agile-info">
        <div class="panel panel-default">
              <div class="panel-heading">
                  SẢN PHẨM MUA
              </div>
        
  <div>
      <table class="table" ui-jq="footable" ui-options='{
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        }}'>
        <caption>
                @if(session('thongbao'))
                <div class="alert alert-success">
                       {{session('thongbao')}}
                </div>
                @endif

                @if(count($errors)>0)
                  <div class="alert alert-danger">
                        @foreach($errors->All() as $err)
                        {{$err}}
                        @endforeach
                  </div>
                @endif

        </caption>
        <thead>
          <tr>
            <th class="text-center" data-breakpoints="xs">ID</th>
            <th class="text-center">Tên sản phẩm</th>
            <th class="text-center">Giá</th>
            <th class="text-center">Phí ship hàng</th>
            <th class="text-center">Số lượng</th>
            <th class="text-center">Tổng tiền</th>

          </tr>
        </thead>
        <tbody>
              @php $i=0;
                   $tong=0;
              @endphp
           @foreach($chitiethoadon as $ct)
              @php $i++;
                    $subtotal = $ct->product_price*$ct->product_sales_quantity;
                    $tong+=$subtotal;
              @endphp
              <tr data-expanded="true" class="text-center">
                    <td>{{$i}}</td>
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
                    <td>
                        <a class="btn btn-primary" target="_blank" href="{{url('/admin/donhang/indonhang/'.$ct->order_code)}}">In đơn hàng</a>
                    </td>

              </tr>
        </tbody>
      </table>
      
  </div>
</div>

@endsection