@extends('admin.layout.index')
  @section('title')
    Tìm kiếm khách hàng
  @endsection
@section('content')
<div class="table-agile-info">
<div class="text-right">
    <form action="admin/khachhang/timkiem" class="form-inline" method="get">
      <div class="form-group mb-2">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="text"  class="form-control-plaintext" Name="tukhoa" value="">
      </div>
      <button type="submit" class="btn btn-primary mb-2" style="margin-bottom:2px;">Tìm kiếm</button>
    </form>
    </div>
  <div class="panel panel-default">
      <div class="panel-heading" >
        KHÁCH HÀNG TÌM TIẾM - {{$tukhoa}}
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
                    <th class="text-center" data-breakpoints="xs">ID</th>
                    <th class="text-center">Tên khách hàng</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Số điện thoại</th>
                    <th class="text-center">Trạng thái</th>
                    <th colspan="2" data-breakpoints="xs sm md" class="text-center" data-title="DOB">Hoạt động</th>
                </tr>
            </thead>
            <tbody>
              @foreach($khachhang as $kh)
                <tr data-expanded="true" class="text-center">
                    <td>{{$khachhang->firstItem()+$loop->index}}</td>
                    <td>{{$kh->customer_name}}</td>
                    <td>{{$kh->customer_email}}</td>
                    <td>{{$kh->customer_phone}}</td>

                    <td>
                      @if($kh->customer_status ==0)
                            <a href="{{url('/admin/khachhang/Mokhoa/'.$kh->customer_id)}}"><i class="fas fa-ban"></i></a>
                        @else
                            <a href="{{url('/admin/khachhang/Khoa/'.$kh->customer_id)}}"><i class="fas fa-check-circle"></i></a>
                     @endif
                    </td>
                    <td><a href="{{url('/admin/khachhang/xoa/'.$kh->customer_id)}}" onclick="return Xoa()"><i class="fas fa-trash-alt"></i>Delete</a></td>                 
                </tr>
              @endforeach
            </tbody>
        </table>
        <div class="text-right">
        {{--{{$khachhang->link()}}--}}
		{{$khachhang->appends(Request::all())->links()}}
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
<script>
  function Xoa(){

    var conf = confirm("Bạn có chắc muốn xóa khách hàng này hay không");
    return conf;
  }
</script>

@endsection