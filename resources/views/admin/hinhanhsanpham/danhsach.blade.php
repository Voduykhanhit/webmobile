@extends('admin.layout.index')
@section('title')
Danh sách hình ảnh
@endsection
@section('content')
<div class="table-agile-info">
<div class="text-left" id="button">
        <a href="{{url('/admin/hinhanhsanpham/them')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</a>
        <a href="" class="btn btn-success" data-toggle="modal" data-target="#importModal"><i class="fas fa-file-upload"></i> Nhập từ Excel</a>
        <a href="{{url('/admin/hinhanhsanpham/xuatexcel')}}" class="btn btn-warning" ><i class="fas fa-file-upload"></i> Xuất Excel</a>
    </div>
    
 <div class="panel panel-default">
    <div class="panel-heading">
    Danh sách hình ảnh
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
                    <th class="text-center">Hình ảnh</th>
                    <th class="text-center">Sản phẩm</th>
                    <th colspan="2" data-breakpoints="xs sm md" class="text-center" data-title="DOB">Hoạt động</th>
                </tr>
            </thead>
            <tbody>
            
              @foreach($hinhanh as $ha)
                <tr data-expanded="true" class="text-center">
                    <td>{{$hinhanh->firstItem()+$loop->index}}</td>
                    <td><img width="80px" src="upload/hinhanhsanpham/{{$ha->image}}" alt=""></td>
                    <td>{{$ha->sanpham->product_name}}</td>
                    <td><a href="{{url('/admin/hinhanhsanpham/sua/'.$ha->image_id)}}"><i class="fas fa-edit"></i>Edit</a></td>
                    <td>
                    <a href="{{url('/admin/hinhanhsanpham/xoa/'.$ha->image_id)}}" onclick="return Xoa()"><i class="fas fa-trash-alt"></i>Delete</a>
                    </td>
                </tr>
              @endforeach
             
            </tbody>
           
      </table>
      <div class="text-right">
      {{$hinhanh->links()}}
      </div>
    </div>
  </div>
</div>
<form action="{{url('/admin/hinhanhsanpham/nhapexcel')}}" method="post" enctype="multipart/form-data">
  @csrf
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel">
     <div class="modal-dialog">
      <div class="modal-content">
       <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span> 
          </button> 
          </div> 
          <div class="modal-body"> 
           <div class="form-group"> 
             <label for="file_excel" class="col-form-label">Chọn tập tin Excel</label> 
             <input type="file" class="form-control-file" id="file_excel" name="file_excel" required /> 
             </div>
              </div> 
              <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button> 
               <button type="submit" class="btn btn-danger"><i class="fas fa-file-upload"></i> Nhập dữ liệu</button>
            </div>
          </div> 
       </div>
    </div> 
</form>
@endsection
@section('script')
<script>
  function Xoa(){

    var conf = confirm("Bạn có chắc muốn xóa hình ảnh này hay không");
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






