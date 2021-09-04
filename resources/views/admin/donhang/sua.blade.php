@extends('admin.layout.index')
    @section('title')
        Edit đơn hàng
    @endsection
@section('content')
                <form action="{{url('/admin/donhang/edit/'.$order->order_id)}}" method="post"   >
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
                                <label for="TrangThaiHT" style="color:#FFFFFF;">Trạng thái hiện tại</label>
                                <input type="text" class="form-control" disabled id="TrangThaiHT" name="TrangThaiHT" 
                                value="
                                @if($order->order_status==1)
                                    Đơn hàng mới
                                @elseif($order->order_status==2)
                                    Đang xác nhận
                                @elseif($order->order_status==3)
                                     Đã hủy
                                @elseif($order->order_status==4)
                                     Đóng gói sản phẩm
                                @elseif($order->order_status==5)
                                    Chờ nhận hàng
                                @elseif($order->order_status==6)
                                    Đang chuyển
                                @elseif($order->order_status==7)
                                    Thất bại
                                @elseif($order->order_status==8)
                                    Đang chuyển hoàn
                                @elseif($order->order_status==9)
                                    Đã chuyển hoàn
                                @elseif($order->order_status==10)
                                    Thành công
                        @endif">
                             </div>
                        <div class="form-group">
                            <label for="TrangThai" style="color:#FFFFFF;">Trạng thái đơn hàng</label>
                            <select class="form-control chon" id="TrangThai" name="TrangThai">   
                                <option value="0">--Chọn trạng thái--</option>
                                <option value="1">Đơn hàng mới</option>
                                <option value="2">Đang xác nhận</option>
                                <option value="3">Đã hủy</option>
                                <option value="4">Đang đóng gói sản phẩm</option>
                                <option value="5">Chờ nhận</option>
                                <option value="6">Đang chuyển</option>
                                <option value="7">Thất bại</option>
                                <option value="8">Đang chuyển hoàn</option>
                                <option value="9">Đã chuyển hoàn</option>
                                <option value="10">Thành công</option>
                            </select>
                        </div>
                <button type="button" data-toggle="modal" data-target="#ModalEdit"  class="btn btn-primary"><i class="far fa-edit"></i> Edit</button>
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
                            Bạn đồng ý sửa trạng thái đơn hàng này hay không?
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
