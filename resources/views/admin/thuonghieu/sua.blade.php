@extends('admin.layout.index')
  @section('title')
     Sửa thương hiệu
  @endsection
@section('content')
<form action="{{url('admin/thuonghieu/sua/'.$thuonghieu->brand_id)}}" method="post">
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
                          <input type="text" class="form-control" name="Ten" value="{{$thuonghieu->brand_name}}" placeholder="name@example.com">
                      </div>
                      <div class="form-group">
                          <label for="NoiDung">Nội dung</label>
                          <textarea class="form-control ckeditor" name="NoiDung"  rows="3">{{$thuonghieu->brand_desc}}</textarea>
                      </div>
                      <div class="form-group">
                            <label for="Ten">Trạng Thái:</label> 
                            <label class="radio-inline">
                                <input name="TrangThai" value="0" checked="@if(($thuonghieu->brand_status)==0){{'checked'}}@endif" type="radio">Ẩn
                            </label>
                            <label class="radio-inline">
                                <input name="TrangThai" value="1" checked="@if(($thuonghieu->brand_status)==1){{'checked'}}@endif" type="radio">Hiện
                            </label>
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
                                                        Bạn đồng ý sửa thương hiệu này hay không?
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
      }, 2000);  
});
</script>

@endsection