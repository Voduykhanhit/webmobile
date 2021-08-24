@extends('admin.layout.index')
    @section('title')
        Sửa Slide
    @endsection
@section('content')
        <form action="{{url('/admin/slide/sua/'.$slide->slide_id)}}" method="post" enctype="multipart/form-data">

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
                        <label for="Ten" style="color:#FFFFFF;">Tên Slide</label>
                        <input type="text" class="form-control" name="Ten" placeholder="Nhập tên sản phẩm">
                </div>


                <div class="form-group">
                        <label for="Hinh" style="color:#FFFFFF;">Hình ảnh</label>
                        <img src="upload/slide/{{$slide->slide_image}}" alt="">
                        <input type="file" class="form-control-file" name="Hinh">
                </div>
  
                <div class="form-group">
                        <label for="NoiDung" style="color:#FFFFFF;">Nội dung</label>
                        <textarea class="form-control ckeditor" name="NoiDung"  rows="3">{{$slide->slide_content}}</textarea>
                </div>

                <div class="form-group"> 
                        <label for="link" style="color:#FFFFFF;">Link</label>
                        <input type="text" class="form-control" name="link" value="{{$slide->slide_link}}" placeholder="Nhập link Slide">
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
                                                        Bạn đồng ý sửa slide này hay không?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Save</button>
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