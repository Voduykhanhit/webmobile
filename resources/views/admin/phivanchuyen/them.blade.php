@extends('admin.layout.index')
@section('title')
Thêm phí vận chuyển
@endsection
@section('content')
<form >
                            <caption>
                                  @if(count($errors)>0)
                                    <div class="alert alert-danger">
                                          @foreach($errors->All() as $err)
                                          {{$err}}
                                          @endforeach
                                    </div>
                                @endif
                            </caption>
                        

                        <div class="form-group">
                          <label for="TinhThanhPho" style="color:#FFFFFF;">Tỉnh thành phố</label>
                          <select class="form-control chon TinhThanhPho" id="TinhThanhPho" name="TinhThanhPho">
                                    
                                    <option value="0">--Chọn tỉnh thành phố--</option>
                                @foreach($city as $ct)
                                   <option value="{{$ct->matp}}">{{$ct->name_city}}</option>
                                @endforeach
                            
                          </select>
                        </div>

                      <div class="form-group">
                          <label for="QuanHuyen" style="color:#FFFFFF;">Quận huyện</label>
                          <select class="form-control QuanHuyen chon" id="QuanHuyen" name="QuanHuyen">
                        
                            <option value="0">--Chọn quận huyện--</option>
                          
                          </select>
                      </div>

                      <div class="form-group">
                          <label for="QuanHuyen" style="color:#FFFFFF;">Xã phường thị trấn</label>
                          <select class="form-control XaPhuong" id="XaPhuong" name="XaPhuong">
                        
                             <option value="0">--Chọn xã phường--</option>
                          
                          </select>
                      </div>
                      <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <label for="PhiVanChuyen" style="color:#FFFFFF;">Phí vận chuyển</label>
                            <input type="text" class="form-control PhiVanChuyen" id="PhiVanChuyen" name="PhiVanChuyen" placeholder="Nhập phí vận chuyển">
                      </div>
                 

                 


              

                
                <button type="button" data-toggle="modal" data-target="#ModalAdd"  class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</button>
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
                                                        Bạn đồng ý thêm phí vận chuyển này hay không?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button class="btn btn-success ThemPhiVanChuyen" name="ThemPhiVanChuyen"><i class="far fa-save"></i> Save</button>
                                                    <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                              </div>
</form>
<br>
                <div class="table-agile-info">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    Phí vận chuyển các tỉnh thành
                    </div>
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
          <div class="alert alert-success">
            {{session('thongbao')}}
          </div>
          @endif

          @if(count($errors)>0)
            <div class="alert alert-danger">
              @foreach($errors->All() as $err)
              {{$err}}
              @endforeach

            </div>
          @endif

        </caption>
        <thead>
          <tr>
            <th class="text-center" data-breakpoints="xs">ID</th>
            <th class="text-center">Tên thành phố</th>
            <th class="text-center">Tên quận huyện</th>
            <th class="text-center">Tên xã phường</th>
            <th class="text-center">Phí vận chuyển</th>
            <th class="text-center">Hành động</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach($phivanchuyen as $pvc)
          <tr data-expanded="true" class="text-center">
            <td>{{$phivanchuyen->firstItem()+$loop->index}}</td>
            <td>{{$pvc->tinhthanhpho->name_city}}</td>
            <td>{{$pvc->quanhuyen->name_quanhuyen}}</td>
            <td>{{$pvc->xaphuongthitran->name_xaphuong}}</td>
            <td contenteditable="true" class="fee_feeship_edit" data-feeship_id="{{$pvc->fee_id}}">{{number_format($pvc->fee_feeship)}}đ</td>
            <td><a href="{{url('admin/phivanchuyen/xoa/'.$pvc->fee_id)}}" onclick="return Xoa()"><i class="fas fa-trash-alt"></i>Delete</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="text-right" style="margin-top:5px;">
        {{$phivanchuyen->links()}}
      </div>
      </div>
      </div>
@endsection

@section('script')
  <script>
  //Thêm phí vận chuyển 
  $(document).ready(function(){
    $('.ThemPhiVanChuyen').click(function(){
      var TinhThanhPho = $('.TinhThanhPho').val();
      var QuanHuyen = $('.QuanHuyen').val();
      var XaPhuong = $('.XaPhuong').val();
      var PhiVanChuyen = $('.PhiVanChuyen').val();
      var _token = $('input[name="_token"]').val();

      $.ajax({
          url: ('admin/phivanchuyen/postthem'),
          method: 'POST',
          data: {TinhThanhPho:TinhThanhPho,QuanHuyen:QuanHuyen,XaPhuong:XaPhuong,PhiVanChuyen:PhiVanChuyen,_token:_token},
          success:function(data){
            toastr.success('Thêm phí vận chuyển thành công!!!');
            location.reload();
          }
      });
      
    });
    //Edit phí vấn chuyển
    $(document).on('blur','.fee_feeship_edit',function(){
        var feeship_id = $(this).data('feeship_id'); // lấy id trong bảng chuyền lên để sửa trong data-feeship_id trên dòng <td> hiển thị
        var feeship_value = $(this).text(); // lấy số tiền từ feeship_id hiển thị ra
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url: ('admin/phivanchuyen/sua'),
          method: 'POST',
          data: {feeship_id:feeship_id,feeship_value:feeship_value,_token:_token},
          success:function(data){
            toastr.success('Chỉnh sửa phí vận chuyển thành công!!!');  
            window.location.reload();
          }
        });
       
    });

    //Hiển thị lên các thẻ Select khi ấn vào 1 tỉnh thành phố nào đó
    $('.chon').on('change',function(){
        var action = $(this).attr('id');
        var matp = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result = '';
      
        if(action=='TinhThanhPho')
        {
          result = 'QuanHuyen';
        }else{
          result = 'XaPhuong';
        }
        
        $.ajax({
          url: ('admin/phivanchuyen/selectpvc'),
          
          method: 'POST',
          data: {action:action,matp:matp,_token:_token},
          success:function(data){
            
            $('#'+result).html(data);
          }
        });
    });

  })
  
  
  </script>
  <script>
  function Xoa() {

    var conf = confirm("Bạn có chắc muốn xóa phí vận chuyển này hay không");
    return conf;
  }
</script>
@endsection