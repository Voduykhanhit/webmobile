@extends('admin.layout.index')
@section('title')
Edit danh mục
@endsection
@section('content')
            <form action="{{url('/admin/danhmucsanpham/sua/'.$danhmuc->category_id)}}" method="post">
                        @if(count($errors)>0)
                            <div class="alert alert-danger" id="alert">
                                @foreach($errors->All() as $err)
                                     {{$err}}
                                @endforeach
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <label for="Ten">Tên danh mục</label>
                            <input type="text" class="form-control" name="Ten" placeholder="Điền tên danh mục" value="{{$danhmuc->category_name}}">
                        </div>
                        <div class="form-group">
                            <label for="NoiDung">Nội dung</label>
                            <textarea class="form-control ckeditor" name="NoiDung"  rows="3">{{$danhmuc->category_desc}}</textarea>
                        </div>
  
                        <div class="form-group">
                             <label for="Ten">Trạng Thái:</label> 

                                <label class="radio-inline">
                                        <input name="TrangThai" value="0" checked="@if(($danhmuc->category_status)==0){{'checked'}}@endif" type="radio">Ẩn
                                </label>

                                <label class="radio-inline">
                                        <input name="TrangThai" value="1" checked="@if(($danhmuc->category_status)==1){{'checked'}}@endif" type="radio">Hiện
                                </label>
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEdit"><i class="far fa-edit"></i> Edit</button>
                        <button type="reset" class="btn btn-primary"><i class="fas fa-spinner"></i> Làm mới</button>
                
  
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
                                    Bạn đồng ý sửa danh mục này hay không?
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