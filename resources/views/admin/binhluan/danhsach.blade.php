@extends('admin.layout.index')
@section('title')
Danh sách bình luận
@endsection
@section('content')
<div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
    DANH SÁCH BÌNH LUẬN
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
                <th class="text-center" data-breakpoints="xs">ID</th>
                <th class="text-center" witdh="20%">Trả lời bình luận</th>
                <th class="text-center" witdh="10%">Tên</th>
                <th class="text-center" witdh="20%">Nội dung</th>
                <th class="text-center" witdh="5%">Sản phẩm bình luận</th>
                <th class="text-center" witdh="5%">Trạng thái</th>
                <th class="text-center" witdh="10%" colspan="2">Hành động</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach($comment as $cm)
                  <tr data-expanded="true" class="text-center">
                        <td>
                        {{$comment->firstItem()+$loop->index}}
                        </td>
                        <td class="text-left">
                            @php
                                $admin_id =  Auth::user()->admin_id;
                            @endphp
                        <ul >
                      @foreach($reply as $rl)
                          @if($cm->comments_id == $rl->comments_id)
                              <li style="list-style-type:decimal;" > {{$rl->reply_content}}</li>
                          @endif
                      @endforeach
                      </ul>
                        <form action="{{url('/admin/binhluan/traloibinhluan')}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="admin_id" value="{{$admin_id}}">
                            <input type="hidden" name="comments_id" value="{{$cm->comments_id}}">
                            <textarea name="NoiDung" id="NoiDung" cols="30" rows="3"></textarea><br>
                            <input type="button" data-toggle="modal" data-target="#ModalReply" class="btn btn-success" value="Trả lời">
                            <!--Modal check-->
            
                            <div class="modal fade" id="ModalReply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thông Báo</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Bạn đồng ý trả lời bình luận này hay không?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button class="btn btn-success"><i class="far fa-save"></i> Save</button>
                                                    <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                              </div>
                        </form>
                      
                        </td>
                        <td>{{$cm->comments_name}}</td>
                        <td>{{$cm->comments_content}}</td>
                        <td>{{$cm->sanpham->product_name}}</td>
                        <td>
                          @if($cm->comments_status==0)
                                <a href="{{url('/admin/binhluan/anbinhluan/'.$cm->comments_id)}}"><i class="fas fa-ban"></i></a>
                            @else
                                <a href="{{url('/admin/binhluan/hienbinhluan/'.$cm->comments_id)}}"><i class="fas fa-check-circle"></i></a>
                          @endif
                        
                      </td>
                        <td><a href="{{url('/admin/binhluan/xoabinhluan/'.$cm->comments_id)}}"><i class="fas fa-trash-alt"></i>Delete</a></td>
                    
                  </tr>
              @endforeach
            </tbody>
      </table>
      <div class="text-right">
      {{$comment->links()}}
      </div>
    </div>
  </div>
</div>
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