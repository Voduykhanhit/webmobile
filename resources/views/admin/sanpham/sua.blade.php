@extends('admin.layout.index')
@section('title')
Sửa sản phẩm
@endsection
@section('content')
<form action="{{url('/admin/sanpham/sua/'.$sanpham->product_id)}}" method="post" enctype="multipart/form-data">
                    <caption>
                    
                    @if(count($errors)>0)
                          <div class="alert alert-danger" id="alert">
                              @foreach($errors->All() as $err)
                                {{$err}} <br>
                              @endforeach
                          </div>
                    @endif
                    @if(session('thongbaoloi'))
                           <div class="alert alert-success" id="alert">
                              {{session('thongbaoloi')}} <br>
                           </div>
                    @endif
                    </caption>
        <div class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <label for="Ten" style="color:#FFFFFF;">Tên sản phẩm</label>
            <input type="text" class="form-control" name="Ten" value="{{$sanpham->product_name}}" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="form-group">
            <label for="DanhMuc" style="color:#FFFFFF;">Tên danh mục</label>
            <select class="form-control" name="DanhMuc" id="DanhMuc">
                    @foreach($danhmuc as $dm)
                        <option @if($sanpham->category_id==$dm->category_id)
                            {{"selected"}}
                            @endif value="{{$dm->category_id}}">{{$dm->category_name}}
                      </option>
                  @endforeach
            </select>
        </div>
        <div class="form-group">
              <label for="ThuongHieu" style="color:#FFFFFF;">Tên thương hiêu</label>
              <select class="form-control" name="ThuongHieu" id="ThuongHieu">
              @foreach($thuonghieu as $th)
                <option @if(($sanpham->brand_id)==($th->brand_id))
                    {{"selected"}}
                    @endif 
                    value="{{$th->brand_id}}">{{$th->brand_name}}
                </option>
              @endforeach
              </select>
        </div>
        <div>
            <label for="ThuongHieu" style="color:#FFFFFF;">Số lượng</label>
            <input type="text" class="form-control" name="SoLuong" value="{{$sanpham->product_quantity}}">
        </div>
        <div class="form-group">
              <label for="MoTa" style="color:#FFFFFF;">Mô tả sản phẩm</label>
              <textarea class="form-control ckeditor" name="MoTa"  rows="3">{{$sanpham->product_desc}}</textarea>
        </div>
        <div class="form-group">
          <label for="NoiDung" style="color:#FFFFFF;">Nội dung</label>
          <textarea class="form-control ckeditor" name="NoiDung"  rows="3">{{$sanpham->product_content}}</textarea>
        </div>
        <div class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
          <label for="Gia" style="color:#FFFFFF;">Giá sản phẩm</label>
          <input type="text" class="form-control" name="Gia" placeholder="Nhập giá sản phẩm" value="{{$sanpham->product_price}}">
        </div>
  
        <div class="form-group">
          <label for="Hinh" style="color:#FFFFFF;">Hình ảnh</label>
          <img src="upload/sanpham/{{$sanpham->product_image}}" alt="">
          <input type="file" class="form-control-file" name="Hinh">
        </div>

        <div class="form-group">
              <label for="TrangThai" style="color:#FFFFFF;">Trạng Thái:</label> <br> 
              <input class="form-check-input" type="radio" value="0" checked="@if(($sanpham->product_status)==0){{'checked'}}@endif" name="TrangThai"> <label style="color:#FFFFFF;" for="TrangThai">Hết hàng</label>
              <input class="form-check-input" type="radio" value="1" checked="@if(($sanpham->product_status)==1){{'checked'}}@endif" name="TrangThai"> <label style="color:#FFFFFF;" for="TrangThai">Còn hàng</label>
        </div>
        <button type="button" data-toggle="modal" data-target="#ModalEdit" class="btn btn-primary"><i class="far fa-edit"></i> Edit</button>
        <button type="reset" class="btn btn-primary"><i class="fas fa-spinner"></i> Làm mới</button>
        <!--Modal check-->
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thông Báo</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Bạn đồng ý sửa sản phẩm này hay không?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" ><i class="far fa-save"></i> Save</button>
                                                    <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                              </div>
  
  
  
</form>
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