<?php

namespace App\Http\Controllers;
use App\BinhLuan;
use App\TraLoiBinhLuan;
use Illuminate\Http\Request;

class BinhLuanController extends Controller
{
    public function getDanhSach(){
            $comment = BinhLuan::paginate(3);
            $reply = TraLoiBinhLuan::all();
            return view('admin.binhluan.danhsach',compact('comment','reply'));
    }
    public function postReply(Request $request)
    {
            $this->validate($request,[
                'NoiDung'=>'required|max:100|min:5'
            ],
            [
            'NoiDung.required'=>'Nội dung không được bỏ trống!!!'
            ]
        
    );
        $reply = new TraLoiBinhLuan;
        $reply->reply_content = $request->NoiDung;
        $reply->comments_id = $request->comments_id;
        $reply->admin_id = $request->admin_id;
        $reply->save();
        return redirect()->back()->with('thongbao','Trả lời bình luận thành công!!!');
    }
    public function getAn($id)
    {
        $comment = BinhLuan::find($id);
        $comment->comments_status = 1;
        $comment->save();
        return redirect()->back()->with('thongbao','Hiện bình luận thành công!!!');
    }
    public function getHien($id)
    {
        $comment = BinhLuan::find($id);
        $comment->comments_status = 0;
        $comment->save();
        return redirect()->back()->with('thongbao','Khóa bình luận thành công!!!');
    }
    public function getXoa($id){
        $comment = BinhLuan::find($id);
        $comment->delete();
        return redirect()->back()->with('thongbao','Xóa bình luận thành công!!!');
    }
}
