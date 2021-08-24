@extends('admin.layout.index')
@section('title')
Sửa hình ảnh
@endsection
@section('content')
                <form action="{{url('/admin/hinhanhsanpham/sua/'.$hinhanh->image_id)}}" method="post" enctype="multipart/form-data">
                            <caption>
                                  @if(count($errors)>0)
                                      <div class="alert alert-danger" id="alert">
                                          @foreach($errors->All() as $err)
                                              {{$err}}
                                          @endforeach
                                      </div>
                                   @endif
                                   @if(session('thongbaoloi'))
                                        <div class="alert alert-success" id="alert">
                                             {{session('thongbaoloi')}}
                                        </div>
                                    @endif
                            </caption>
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </div>

                        <div class="form-group">
                            <label for="SanPham" style="color:#FFFFFF;">Tên sản phẩm</label>
                            <select class="form-control" name="SanPham">
                                    @foreach($sanpham as $sp)
                                       <option @if($hinhanh->product_id ==$sp->product_id){{'Selected'}}@else @endif value="{{$sp->product_id}}">{{$sp->product_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div>
                                   <img src="upload/hinhanhsanpham/{{$hinhanh->image}}" class="img-thumbnail mb-2" alt=""> <br>
                        </div>
                     <div class="form-group">
                    <label for="Hinh" style="color:#FFFFFF;">Hình ảnh</label>
                    <input type="file" class="form-control-file mt-2" name="Hinh">
                  </div>

                 
                <button type="button" data-toggle="modal" data-target="#ModalEdit" class="btn btn-primary"><i class="fas fa-plus"></i> Edit</button>
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
                                        Bạn đồng ý sửa hình ảnh sản phẩm này hay không?
                                    </div>
                                    <div class="modal-footer">
                                    <button class="btn btn-success"><i class="far fa-save"></i> Save</button>
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