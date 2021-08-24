<!-- Modal -->
<div class="modal fade" id="ModalThem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <form  action="{{url('/admin/user/them')}}" method="post" >
              @if(count($errors)>0)
                <div class="alert alert-danger" id="alert">
                    @foreach($errors->All() as $err)
                      {{$err}}
                    @endforeach
                </div>
              @endif
      <div class="modal-header bg-info">
        <h5 class="modal-title" style="color:#FFFFFF;" id="exampleModalLabel">THÊM NGƯỜI DÙNG</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
               <div class="form-group">
                      <input type="hidden" name="_token"  value="{{csrf_token()}}">
                      <label for="Ten">Tên người dùng</label>
                      <input type="text" class="form-control" value ="{{old('Ten')}}" name="Ten" placeholder="Nhập tên người dùng">
              </div>
              <div class="form-group">
                     
                      <label for="Ten">Số điện thoại</label>
                      <input type="text" class="form-control" value ="{{old('SoDienThoai')}}" name="SoDienThoai" >
                    
              </div>
              <div class="form-group">
                     
                      <label for="Ten">Tải khoản</label>
                      <input type="text" class="form-control" value ="{{old('TaiKhoan')}}" name="TaiKhoan" >
                    
              </div>
              <div class="form-group">
                    
                      <label for="Ten">Mật khẩu</label>
                      <input type="password" class="form-control" value ="{{old('MatKhau')}}" name="MatKhau" >
                    
              </div>
              <div class="form-group">
                     
                      <label for="Ten">Xác nhận mật khẩu</label>
                      <input type="password" class="form-control" value ="{{old('XacNhanMatKhau')}}" name="XacNhanMatKhau" >
                    
              </div>    
      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-spinner"></i> Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>