@extends('admin.layout.index')
@section('title')
Thêm thương hiệu
@endsection
@section('content')
<form action="{{url('/admin/thuonghieu/them')}}" method="post">
                         <caption>
                              @if(count($errors)>0)
                                  <div class="alert alert-danger" id="alert">
                                      @foreach($errors->All() as $err)
                                        {{$err}}
                                      @endforeach
                                  </div>
                                @endif
                          </caption>
                          <div class="form-group">
                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <label for="Ten">Tên thương hiệu</label>
                              <input type="text" class="form-control" name="Ten" placeholder="name@example.com">
                          </div>

                          <div class="form-group">
                              <label for="NoiDung">Nội dung</label>
                              <textarea class="form-control ckeditor" name="NoiDung"  rows="3"></textarea>
                          </div>

                          <div class="form-group">
                              <label for="Ten">Trạng Thái:</label> <br> 
                              <input class="form-check-input" type="radio" value="0" name="TrangThai"> <label for="TrangThai">Ẩn</label>
                              <input class="form-check-input" type="radio" value="1" name="TrangThai"> <label for="TrangThai">Hiện</label>
                         </div>
                          <button type="button" data-toggle="modal" data-target="#ModalAdd" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</button>
                          <button type="reset" class="btn btn-primary"><i class="fas fa-spinner"></i> Làm mới</button>
                           <!--Modal check-->
                             <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thông Báo</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Bạn đồng thêm thương hiệu này hay không?
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