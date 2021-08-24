@extends('admin.layout.index')
@section('title')
Danh sách sản phẩm
@endsection
@section('content')
<div class="table-agile-info">
  <div class="text-left" id="button">
    <a href="{{url('/admin/sanpham/them')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</a>
    <a href="" class="btn btn-success" data-toggle="modal" data-target="#importModal"><i class="fas fa-file-upload"></i> Nhập từ Excel</a>
    <a href="{{url('/admin/sanpham/xuatexcel')}}" class="btn btn-warning"><i class="fas fa-file-upload"></i> Xuất Excel</a>
  </div>
  <div class="text-right">
    <form action="admin/sanpham/timkiem" class="form-inline" method="get">
      <div class="form-group mb-2">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="text"  class="form-control-plaintext" Name="tukhoa" value="">
      </div>
      <button type="submit" class="btn btn-primary mb-2" style="margin-bottom:2px;">Tìm kiếm</button>
    </form>
    </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách sản phẩm
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
            <th class="text-center">Tên sản phẩm</th>
            <th class="text-center">Tên danh mục</th>
            <th class="text-center">Tên thương hiệu</th>
            <th class="text-center">Số lượng</th>
            <th class="text-center">Hình ảnh</th>
            <th class="text-center">Trạng thái</th>
            <th colspan="2" data-breakpoints="xs sm md" class="text-center" data-title="DOB">Hoạt động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sanpham as $sp)
          <tr data-expanded="true" class="text-center">
            <td>{{$sanpham->firstItem()+$loop->index}}</td>
            <td>{{$sp->product_name}}</td>
            <td>{{$sp->danhmucsanpham->category_name}}</td>
            <td>{{$sp->thuonghieu->brand_name}}</td>
            <td>{{$sp->product_quantity}}</td>
            <td><a href=""><img width="80px" src="upload/sanpham/{{$sp->product_image}}" alt=""></a></td>
            <td>

              @if($sp->product_quantity>0)
              @php $sp->product_status =1; @endphp
              @if($sp->product_status==1)
              {{'Còn hàng'}}
              @endif
              @else
              @php $sp->product_status = 0; @endphp
              @if($sp->product_status==0)
              {{'Hết hàng'}}
              @endif
              @endif



            </td>
            <td><a href="{{url('/admin/sanpham/sua/'.$sp->product_id)}}"><i class="fas fa-edit"></i>Edit</a></td>
            <td><a href="{{url('admin/sanpham/xoa/'.$sp->product_id)}}" onclick="return Xoa()"><i class="fas fa-trash-alt"></i>Delete</a></td>

          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="text-right">
        {{$sanpham->links()}}
      </div>
    </div>
  </div>
</div>
<form action="{{url('/admin/sanpham/nhapexcel')}}" method="post" enctype="multipart/form-data">
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
  function Xoa() {

    var conf = confirm("Bạn có chắc muốn xóa danh mục này hay không");
    return conf;
  }
</script>
<script>
  $(document).ready(function() {
    window.setTimeout(function() {
      $("#alert").alert('close');
    }, 7000);
  });
</script>

@endsection