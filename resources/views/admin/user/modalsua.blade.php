<!-- Modal -->
<div class="modal fade" id="ModalSua" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <form  action="{{url('/admin/thongtincanhan/'.Auth::user()->admin_id)}}" method="post" >
              @if(count($errors)>0)
                <div class="alert alert-danger" id="alert">
                    @foreach($errors->All() as $err)
                      {{$err}}
                    @endforeach
                </div>
              @endif
      <div class="modal-header bg-info">
        <h5 class="modal-title" style="color:#FFFFFF;" id="exampleModalLabel">Sửa người dùng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     @if(Auth::user()->admin_id != NULL)
      <div class="modal-body">
               <div class="form-group">
                      <input type="hidden" name="_token"  value="{{csrf_token()}}">
                      <label for="Ten">Tên người dùng</label>
                      <input type="text" class="form-control" value ="{{Auth::user()->admin_name}}" name="Ten" placeholder="Nhập tên người dùng">
              </div>
              <div class="form-group">
                     
                      <label for="Ten">Số điện thoại</label>
                      <input type="text" class="form-control" value ="{{Auth::user()->admin_phone}}" name="SoDienThoai" >
                    
              </div>
              <div class="form-group">
                     
                      <label for="Ten">Tải khoản</label>
                      <input type="text" class="form-control" disabled value ="{{Auth::user()->admin_email}}" name="TaiKhoan" >
                    
              </div>
              <div class="form-group">
              <input type="checkbox"  id="changePassword" name="checkpassword"> Đổi mật khẩu <br>
                      <label for="Ten">Mật khẩu</label>
                      <input type="password" class="form-control password" disabled value ="{{old('MatKhau')}}" name="MatKhau" >
                    
              </div>
              <div class="form-group">
                     
                      <label for="Ten">Xác nhận mật khẩu</label>
                      <input type="password" class="form-control password" disabled value ="{{old('XacNhanMatKhau')}}" name="XacNhanMatKhau" >
                    
              </div>    
      </div>
      @endif
      <div class="modal-footer">
        <button type="submit"  class="btn btn-primary"><i class="far fa-save"></i> Sửa thông tin</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-spinner"></i> Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>