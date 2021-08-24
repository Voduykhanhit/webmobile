@extends('admin.layout.index')
  @section('title')
      Danh sách danh mục
  @endsection
  
@section('content')
<div class="table-agile-info">
    <div class="text-left" id="button">
        <a  data-target="#ModalAdd" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm mới</a>
        <!-- href="{{url('/admin/danhmucsanpham/them')}}" -->
    </div>
    <div class="text-right">
    <form action="admin/danhmucsanpham/timkiem" class="form-inline" method="get">
      <div class="form-group mb-2">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="text"  class="form-control-plaintext" Name="tukhoa" value="">
      </div>
      <button type="submit" class="btn btn-primary mb-2" style="margin-bottom:2px;">Tìm kiếm</button>
    </form>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
             Danh sách danh mục
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
            <th class="text-center" data-breakpoints="xs">ID</th>
            <th class="text-center">Tên danh mục</th>
            <th class="text-center">Hiển thị</th>
            <th colspan="2" data-breakpoints="xs sm md" class="text-center" data-title="DOB">Hoạt động</th>
          </tr>
        </thead>
        <tbody>
           @foreach($danhmuc as $dm)
          <tr data-expanded="true" class="text-center">
                <td>{{$danhmuc->firstItem()+$loop->index}}</td>
                <td>{{$dm->category_name}}</td>
                <td>
                  @if($dm->category_status ==0)
                     <a href="{{url('/admin/danhmucsanpham/andanhmuc/'.$dm->category_id) }}"><i class="fas fa-ban"></i></a>
                 @else
                    <a href="{{url('/admin/danhmucsanpham/hiendanhmuc/'.$dm->category_id) }}"><i class="fas fa-check-circle"></i></a>
                  @endif
              </td>
                <td><a type="button" data-url="{{url('/admin/danhmucsanpham/sua/'.$dm->category_id)}}"  class="btn-edit"><i class="fas fa-edit"></i>Edit</a></td>
                <td>
                    <a href="{{url('/admin/danhmucsanpham/xoa/'.$dm->category_id)}}" onclick=" return Xoa()"><i class="fas fa-trash-alt"></i>Delete</a>
                </td>
            
          </tr>
           @endforeach
        </tbody>
      </table>
      <div class="text-right">
        {{$danhmuc->links()}}
      </div>
        <div id="Load">
      
      </div>
    <div>
      
    </div>
  </div>
</div>
@include('admin.danhmucsanpham.modalthem')
@include('admin.danhmucsanpham.modalsua')
@endsection

@section('script')
<!-- Thêm ajax -->
<script type="text/javascript">
$(document).ready(function(){
  $('#form-add').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var _token = $('input[name="_token"]').val();
    var Ten = $('#Ten').val();
    var NoiDung = CKEDITOR.instances.NoiDung.getData();
    var TrangThai = [];
   
    $('.TrangThai').each(function(){
      if($(this).is(":checked")){
        TrangThai.push($(this).val());
      }
     
    });
    TrangThai = TrangThai.toString();
    if(Ten == ""  || NoiDung=="" || TrangThai.checked==false)
    {
      toastr.error('Các trường không được bỏ trống');
    }else if(Ten.length <3){
      toastr.error('Tên phải từ 3 ký tự trở lên');
    }else if(NoiDung.length <2){
      toastr.error('Nội dung phải từ 3 ký tự trở lên');
    }
    else{
    $.ajax({
        url:url,
        type:"POST",
        data:{Ten:Ten,NoiDung:NoiDung,TrangThai:TrangThai,_token:_token},
        
        
        success: function(data)
        {
            
               toastr.success(data.mes);  
              
           $('#ModalAdd').modal('hide');
        
            setTimeout(function(){
              window.location.href="{{url('/admin/danhmucsanpham/danhsach')}}";
           }, 500);  
        },error: function(data){
         var errors = data.responseJSON;
         if($.isEmptyObject(errors)== false)
         {
          $('#error1').text(data.responseJSON.errors.Ten);
          $('#error2').text(data.responseJSON.errors.NoiDung);
          $('#error3').text(data.responseJSON.errors.TrangThai);
         }
          

}
    });
}
  });
}); 
</script>
<!-- Sửa ajax -->
<script>
$(document).ready(function(){
  
  $('.btn-edit').click(function(e){
    var url = $(this).attr('data-url');
    $('#ModalEdit').modal('show');
    var editor = CKEDITOR.instances.NoiDung1;         
    editor.setData(''); 
   
    e.preventDefault();
    $.ajax({
        type:'get',
        url:url,
        success:function(response){
          $('#IdDanhMuc').val(response.data.category_id);
          $('#Ten-Edit').val(response.data.category_name);
         editor.setData(''+response.data.category_desc);    
         var edata = editor.getData();

         if( response.data.category_status == 0) {
    $('.TrangThai-Edit0').prop('checked', true);
      }else{
        $('.TrangThai-Edit1').prop('checked', true);
      }
         
         
        }

    });
    //End ajax
  });
  //End button edit
  $('#form-edit').submit(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        var IdDanhMuc = $('#IdDanhMuc').val();
        var _token = $('input[name="_token"]').val();
        var Ten = $('#Ten-Edit').val();
        var NoiDung = CKEDITOR.instances.NoiDung1.getData();
        var TrangThai = [];
        $('input[name=TrangThai]').each(function(){
          if($(this).is(":checked")){
          TrangThai.push($(this).val());
      }
        });
        TrangThai = TrangThai.toString();
        $.ajax({
            url:url,
            type:'POST',
            data:{_token:_token,IdDanhMuc:IdDanhMuc,Ten:Ten,NoiDung:NoiDung,TrangThai:TrangThai},
            success:function(response){
              toastr.success(response.mes);
              $('#ModalEdit').modal('hide');
              setTimeout(function(){
              window.location.href="{{url('/admin/danhmucsanpham/danhsach')}}";
            }, 500); 
            },error: function(data){
         var errors = data.responseJSON;
         if($.isEmptyObject(errors)== false)
         {
          $('#error4').text(data.responseJSON.errors.Ten);
          $('#error5').text(data.responseJSON.errors.NoiDung);
          $('#error6').text(data.responseJSON.errors.TrangThai);
         }
          

}

        });
        
       
  });
  
});
// end document ready
</script>
<script>
$(document).ready (function(){
    window.setTimeout(function () { 
         $("#alert").alert('close'); 
      }, 7000);  
});
</script>
<!-- confirm thông báo -->
<script>
  function Xoa(){

    var conf = confirm("Bạn có chắc muốn xóa danh mục này hay không");
    return conf;
  }
</script>

@endsection


