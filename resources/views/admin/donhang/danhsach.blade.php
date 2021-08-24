@extends('admin.layout.index')
@section('title')
Danh sách đơn hàng
@endsection
@section('content')
<div class="table-agile-info">

    <div class="panel panel-default">

        <div class="panel-heading">
          Danh sách đơn hàng
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
            <thead>
                <tr>
                      <th class="text-center">STT</th>
                      <th class="text-center">Mã đơn hàng</th>
                      <th class="text-center">Tên người đặt</th>
                      <th class="text-center">Ngày đặt hàng</th>
                      <th class="text-center">Tổng giá tiền</th>
                      <th class="text-center">Tình trạng</th>
                      <th colspan="2" data-breakpoints="xs sm md" class="text-center" data-title="DOB">Hoạt động</th>
                </tr>
            </thead>
            <tbody>
                
               @foreach($donhang as $dh)
                <tr data-expanded="true" class="text-center">
                      <td>{{$donhang->firstItem()+$loop->index}}</td>
                      <td>{{$dh->order_code}}</td>
                      <td>{{$dh->khachhang->customer_name}}</td>
                      <td>{{($dh->created_at)->format('d/m/Y H:i:s')}}</td>
                      <td>{{$dh->order_total}}</td>
                      <td>@if($dh->order_status==1)
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
                      <td><a href="{{url('/admin/donhang/chitiet/'.$dh->order_code)}}"><i class="fas fa-eye"></i> Chi tiết</a></td>
                      <td><a href="{{url('/admin/donhang/edit/'.$dh->order_id)}}"><i class="far fa-edit"></i> Edit</a></td>
                </tr>
              @endforeach
            </tbody>
        </table>
        <div class="text-right">
          {{$donhang->links()}}
        </div>
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