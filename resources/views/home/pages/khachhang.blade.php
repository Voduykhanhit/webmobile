@extends('home.layout.index')
@section('title')
Khách hàng

@endsection





@section('content')

    @include('home.layout.menu')

<div class="col-sm-9 padding-right">
                <caption>
                @if(session('thongbao'))
                    <div class="alert alert-success" id="alert">
                        {{session('thongbao')}}
                    </div>
                 @endif
                 @if(session('thongbaoloi'))
                    <div class="alert alert-danger" id="alert">
                        {{session('thongbaoloi')}}
                    </div>
                 @endif
                 @if(count($errors)>0)
                    <div class="alert alert-danger" id="alert">
                        @foreach($errors->All() as $err)
                            {{$err}}
                        @endforeach
                    </div>
                 @endif

                </caption>
<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>THÔNG TIN CÁ NHÂN</p>
							<div class="form-one">
								<form action="{{url('/home/editcustomer/'.Session::get('customer_id'))}}" method="post">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <label for="">Họ tên</label>
									<input type="text" name="HoVaTen" placeholder="Họ và tên *" value="{{$khachhang->customer_name}}">
                                    <label for="">Email</label>
									<input type="text" name="Email" placeholder="Email*" disabled value="{{$khachhang->customer_email}}">
									<label for="">Số điện thoại</label>
                                    <input type="text" name="Phone" placeholder="Phone *" value="{{$khachhang->customer_phone}}">
                                    <div class="form-group">
                                        <input type="checkbox"  id="changePassword" name="checkpassword"> Đổi mật khẩu <br>
                                        <label for="">Mật khẩu</label>
                                        <input type="password" name="MatKhau" class="form-control password" disabled id="txtvalue" value="" >
                                        <label for="">Xác nhận mật khẩu</label>
                                        <input type="password" name="XNMatKhau" class="form-control password" disabled id="txtvalue" value="" >
									</div>
									  <button type="button" data-toggle="modal" data-target="#ModalAdd" name="sendorder" class="btn btn-primary" style="margin-top:5px;margin-bottom:5px;">Chỉnh sửa</button>
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
                                                        Bạn đồng ý thay đổi hay không!!!
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Đồng ý</button>
                                                    <button class="btn btn-danger" data-dismiss="modal">Hủy bỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                              </div>
								</form>
							</div>
						</div>
					</div>			
				</div>
			</div>	


</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#changePassword").change(function(){
            if($(this).is(":checked"))
            {
                $(".password").removeAttr('disabled');

            }else
            {
                $(".password").attr('disabled','');
            }
        });
    });


</script>
<script>
    $(document).ready (function(){
        window.setTimeout(function () { 
            $("#alert").alert('close'); 
        }, 7000);  
    });
</script>
@endsection