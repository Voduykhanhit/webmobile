<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form data-url="{{url('/admin/danhmucsanpham/sua')}}" action="" id="form-edit">
      <div class="modal-header bg-info">
        <h5 class="modal-title" style="color:#FFFFFF;" id="exampleModalLabel">THÊM DANH MỤC</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
      <div class="form-group">
                      <input type="hidden" name="_token"  value="{{csrf_token()}}">
                      <input type="hidden" name="IdDanhMuc" id="IdDanhMuc">
                      <label for="Ten">Tên danh mục</label>
                      <input type="text" class="form-control" value ="{{old('Ten')}}" name="Ten" id="Ten-Edit" placeholder="Nhập tên danh mục">
                      <span id="error4"></span>
              </div>
              <div class="form-group">
                    <label for="NoiDung">Nội dung</label>
                    <textarea class="form-control ckeditor"  name="NoiDung1" id="NoiDung1"  rows="3">{{old('NoiDung')}}</textarea>
                    <span id="error5"></span>
              </div>
              <div class="form-group">
                    <label for="Ten">Trạng Thái:</label> <br>
                    
                    <input class="form-check-input TrangThai-Edit0" type="checkbox" value="0"  name="TrangThai" > <label for="trangthai">Ẩn</label>
                    <input class="form-check-input TrangThai-Edit1" type="checkbox" value="1" name="TrangThai"  > <label for="trangthai">Hiện</label>
                    <span id="error6"></span>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn btn-primary"><i class="fas fa-plus"></i>Chỉnh Sửa</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-spinner"></i> Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>