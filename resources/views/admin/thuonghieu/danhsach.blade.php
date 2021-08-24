@extends('admin.layout.index')
  @section('title')
    Danh sách thương hiệu
  @endsection
@section('content')
<div class="table-agile-info">
<div class="text-left" id="button">
        <a href="{{url('/admin/thuonghieu/them')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</a>
    </div>
  <div class="panel panel-default">
      <div class="panel-heading" >
          Danh sách thương hiệu
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
                    <th class="text-center">Tên thương hiệu</th>
                    <th class="text-center">Trạng thái</th>
                    <th colspan="2" data-breakpoints="xs sm md" class="text-center" data-title="DOB">Hoạt động</th>
                </tr>
            </thead>
            <tbody>
              @foreach($thuonghieu as $th)
                <tr data-expanded="true" class="text-center">
                <td>{{$thuonghieu->firstItem()+$loop->index}}</td>
                    <td>{{$th->brand_name}}</td>
                    <td>

                      @if($th->brand_status ==0)
                    
                  
                        <a href="{{url('/admin/thuonghieu/andanhmuc/'.$th->brand_id)}}"><i class="fas fa-ban"></i></a>
                     @else

                      
                        <a href="{{url('/admin/thuonghieu/hiendanhmuc/'.$th->brand_id)}}"><i class="fas fa-check-circle"></i></a>
                      @endif
                    </td>
                    <td><a href="{{url('/admin/thuonghieu/sua/'.$th->brand_id)}}"><i class="fas fa-edit"></i>Edit</a></td>
                    <td><a href="{{url('/admin/thuonghieu/xoa/'.$th->brand_id)}}" onclick="return Xoa()"><i class="fas fa-trash-alt"></i>Delete</a></td>                 
                </tr>
              @endforeach
            </tbody>
        </table>
        <div class="text-right">
        {{$thuonghieu->links()}}
        </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  function Xoa(){

    var conf = confirm("Bạn có chắc muốn xóa danh mục này hay không");
    return conf;
  }
</script>
<script>
$(document).ready (function(){
    window.setTimeout(function () { 
         $("#alert").alert('close'); 
      }, 7000);  
});
</script>
@endsection