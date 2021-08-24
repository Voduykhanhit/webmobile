@extends('admin.layout.index')
@section('title')
Danh sách Slide
@endsection
@section('content')
<div class="table-agile-info">
<div class="text-left" id="button">
        <a href="{{url('/admin/slide/them')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</a>
    </div>
 <div class="panel panel-default">
    <div class="panel-heading" >
         Danh sách Slide
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
                    <th width="5%" class="text-center" data-breakpoints="xs">ID</th>
                    <th width="10%" class="text-center">Tên Slide</th>
                    <th width="50%" class="text-center">Hình Ảnh</th>
                    <th width="10%" class="text-center">Nội Dung</th>
                    <th width="10%" class="text-center">Link</th>
                    <th width="15%" colspan="2" data-breakpoints="xs sm md" class="text-center" data-title="DOB">Hoạt động</th>
                </tr>
            </thead>
            <tbody>
              @foreach($slide as $sl)
                <tr data-expanded="true" class="text-center">
                    <td>{{$sl->slide_id}}</td>
                    <td>{{$sl->slide_name}}</td>
                    <td><img width="300px" src="upload/slide/{{$sl->slide_image}}" alt=""></td>
                    <td>{{$sl->slide_content}}</td>
                    <td>{{$sl->slide_link}}</td>
                    <td><a href="{{url('/admin/slide/sua/'.$sl->slide_id)}}"><i class="fas fa-edit"></i>Edit</a></td>
                    <td><a href="{{url('/admin/slide/xoa/'.$sl->slide_id)}}" onclick="return Xoa()"><i class="fas fa-trash-alt"></i>Delete</a></td>
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