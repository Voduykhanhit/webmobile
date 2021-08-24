<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SanPham;
use App\ThuongHieu;
use App\DanhMucSanPham;
use App\Slide;

class SlideController extends Controller
{
    public function getDanhSach()
    {
            $slide = Slide::all();
            return view('admin.slide.danhsach',compact('slide'));
    }

    public function getThem()
    {
            return view('admin.slide.them');
    }

    public function postThem(Request $request)
    {
        $slide = new Slide;
            $this->validate($request,
            
            [
            'Ten'=>'required|unique:tbl_slide,slide_name|min:3|max:100',
            'NoiDung'=>'required',
            'link'=>'required'
            ],
            [
                'Ten.required'=>'Tên không được bỏ trống',
                'Ten.unique'=>'Tên đã tồn tại trong CSDL',
                'Tên.min'=>'Tên phải từ 3 ký tự trở lên',
                'Ten.max'=>'Tên tối đa 100 ký tự',
                'NoiDung.required'=>'Nội dung không được bỏ trống',
                'link.required'=>'link không được bỏ trống'
            ]
            );
            if($request->hasFile('Hinh'))
            {
                $file = $request->file('Hinh');
                $duoi = $file->getClientOriginalExtension();
                if($duoi !='png' && $duoi!='jpeg' && $duoi!='jpg')
                {
                    return redirect('admin/slide/them')->with('thongbaoloi','Bạn phải thêm hình có đuôi dạng PNG AND JPEG AND JPG');

                }
                $name = $file->getClientOriginalName();
                $Hinh = Str::random(4)."_".$name;
                while(file_exists("upload/slide/".$Hinh))
                {
                    $Hinh = Str::random(4)."_".$name;
                }
                $file->move("upload/slide",$Hinh);
                $slide->slide_image = $Hinh;
            }else{
                $slide->slide_image = "";
            }
            
            $slide->slide_name = $request->Ten;
            $slide->slide_content = $request->NoiDung;
            $slide->slide_link = $request->link;
            $slide->save();
            return redirect('admin/slide/danhsach')->with('thongbao','Thêm thành công Slide: '.$request->Ten);
    }

    public function getSua($id)
    {
        $slide = Slide::find($id);
        return view('admin/slide/sua',compact('slide'));
    }
    public function postSua(Request $request,$id)
    {
        $slide = Slide::find($id);
        $this->validate($request,
            
        [
        'Ten'=>'required|unique:tbl_slide,slide_name|min:3|max:100',
        'NoiDung'=>'required',
        'link'=>'required'
        ],
        [
            'Ten.required'=>'Tên không được bỏ trống',
            'Ten.unique'=>'Tên đã tồn tại trong CSDL',
            'Tên.min'=>'Tên phải từ 3 ký tự trở lên',
            'Ten.max'=>'Tên tối đa 100 ký tự',
            'NoiDung.required'=>'Nội dung không được bỏ trống',
            'link.required'=>'link không được bỏ trống'
        ]
        );
        if($request->hasFile('Hinh'))
            {
                $file = $request->file('Hinh');
                $duoi = $file->getClientOriginalExtension();
                if($duoi !='png' && $duoi!='jpeg' && $duoi!='jpg')
                {
                    return redirect('admin/slide/them')->with('thongbaoloi','Bạn phải thêm hình có đuôi dạng PNG AND JPEG AND JPG');

                }
                $name = $file->getClientOriginalName();
                $Hinh = Str::random(4)."_".$name;
                while(file_exists("upload/slide/".$Hinh))
                {
                    $Hinh = Str::random(4)."_".$name;
                }
                $file->move("upload/slide",$Hinh);
                if($slide->slide_image != null)
                {
                    unlink("upload/slide/".$slide->slide_image);
                }
             
                $slide->slide_image = $Hinh;
            }
            
            $slide->slide_name = $request->Ten;
            $slide->slide_content = $request->NoiDung;
            $slide->slide_link = $request->link;
            $slide->save();
            return redirect('admin/slide/danhsach')->with('thongbao','Edit thành công Slide: '.$request->Ten);
    }
    public function getXoa($id)
    {
            $slide = Slide::find($id);
            if($slide->slide_image != null)
            {
                unlink("upload/slide/".$slide->slide_image);
            }
            $slide->delete();
            return redirect('admin/slide/danhsach')->with('thongbao','Delete thành công Slide: '.$id);
    }
}
