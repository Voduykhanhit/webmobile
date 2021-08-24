@extends('admin.layout.index')
@section('title')
Danh sách người dùng
@endsection
@section('content')
<div class="table-agile-info">
    <div class="text-left" style="margin-bottom:5px;">
    <a href="" data-toggle="modal" data-target="#ModalThem" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</a>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
         DANH SÁCH NGƯỜI DÙNG
      </div>
    <div>
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
                <div class="alert alert-success" id="alert">
                  {{session('thongbao')}}
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
              <thead>
                  <tr>
                      <th class="text-center" width="10%" >Tên user</th>
                      <th class="text-center" width="30%" >Email</th>
                      <th class="text-center" width="15%" >Phone</th>
                      <th class="text-center" width="5%">Admin</th>
                      <th class="text-center" width="5%">Nhân Viên</th>
                      <th class="text-center" width="5%">Hỗ trợ</th>
                      <th class="text-center" width="15%">Hành động</th>
                  </tr>
              </thead>
              <tbody>
              @foreach($admin as $user)
                  <form action="{{url('/admin/user/phanquyen')}}" method="POST">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <input type="hidden" name="admin_id" value="{{$user->admin_id}}">
                      <tr data-expanded="true" class="text-center">
                          <td>{{$user->admin_name}}</td>
                          <td>{{$user->admin_email}}
                            <input type="hidden" name="admin_email" value="{{$user->admin_email}}">
                          </td>
                          <td>{{$user->admin_phone}}</td>
                          <td>
                            <input type="checkbox" name="admin_role"  {{ $user->hasRole('Admin') ? 'checked' :'' }} >
                          </td>
                          <td>
                            <input type="checkbox" name="editor_role" {{ $user->hasRole('NhanVienQuanLy') ? 'checked' :'' }}>
                          </td>
                          <td>
                            <input type="checkbox" name="censorship_role" {{ $user->hasRole('NhanVienHoTro') ? 'checked' :'' }}>
                          </td>
                          <td>
                              <p><input type="submit" value="Cấp quyền" class="btn btn-success" > </p>
                            <p> <a href="{{url('/admin/user/deleteuser/'.$user->admin_id)}}" onclick="return Xoa()" style="margin-top:4px;" class="btn btn-danger mt-2">Xóa User</a></p>
                          </td>
                             
                      </tr>
                  </form>
                @endforeach
                
              </tbody>
        </table>
      {{ $admin->links() }}
    </div>
  </div>
  @include('admin.user.modalthem')
</div>
@endsection
@section('script')
<script>
  function Xoa(){

    var conf = confirm("Bạn có chắc muốn xóa danh mục này hay không");
    return conf;
  }
</script>
<script>
$(document).ready (function(){
    window.setTimeout(function () { 
         $("#alert").alert('close'); 
      }, 7000);  
});
</script>
@endsection
