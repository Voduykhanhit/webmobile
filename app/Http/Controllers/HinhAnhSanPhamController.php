<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SanPham;
use App\ThuongHieu;
use App\DanhMucSanPham;
use App\HinhAnhSanPham;
use App\Imports\HinhAnhSanPhamImport;
use App\Exports\HinhAnhSanPhamExport;
use Illuminate\Support\Facades\DB;
use Excel;


class HinhAnhSanPhamController extends Controller
{
    public function getDanhSach(){
        $hinhanh = HinhAnhSanPham::orderBy('image_id','DESC')->paginate(5);
        return view('admin.hinhanhsanpham.danhsach',compact('hinhanh'));
    }
    public function getThem()
    {
            $sanpham = SanPham::all();
           return view('admin.hinhanhsanpham.them',compact('sanpham'));
    }

    public function postThem(Request $request)
    {
           $hinhanh = new HinhAnhSanPham; 
        $this->validate($request,
            [
                'SanPham'=>'required'
            ],
            [
                'SanPham.required'=>'Bạn phải lựa chọn tên sản phẩm'
            ]
            );
            if($request->hasFile('Hinh'))
            {
                $file = $request->file('Hinh');
                $duoi = $file->getClientOriginalExtension();
                if($duoi !='png' && $duoi!='jpeg' && $duoi!='jpg')
                {
                    return redirect('admin/hinhanhsanpham/them')->with('thongbaoloi','Bạn phải thêm hình ảnh có đuôi là PNG AND JPEG AND JPG');
                }
                $name = $file->getClientOriginalName();
                $Hinh = Str::random(4)."_".$name;
                while(file_exists("upload/hinhanhsanpham/".$Hinh))
                {
                    $Hinh = Str::random(4)."_".$name;
                }
                $file->move("upload/hinhanhsanpham",$Hinh);
                $hinhanh->image = $Hinh;
            }else{
                $hinhanh->image = "";
            }
            $hinhanh->product_id = $request->SanPham;
            $hinhanh->save();
            return redirect('admin/hinhanhsanpham/danhsach')->with('thongbao','Thêm thành công hình ảnh sản phẩm: '.$request->SanPham);

    }

    public function getSua($id)
    {
           $hinhanh = HinhAnhSanPham::find($id);
           $sanpham = SanPham::all();
           return view('admin.hinhanhsanpham.sua',compact('hinhanh','sanpham')); 
    }
    public function postSua(Request $request,$id)
    {
        $hinhanh = HinhAnhSanPham::find($id);
        $this->validate($request,
        [
            'SanPham'=>'required'
        ],
        [
            'SanPham.required'=>'Bạn phải lựa chọn tên sản phẩm'
        ]
        );
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi !='png' && $duoi!='jpeg' && $duoi!='jpg')
            {
                return redirect('admin/hinhanhsanpham/them')->with('thongbaoloi','Bạn phải thêm hình ảnh có đuôi là PNG AND JPEG AND JPG');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists("upload/hinhanhsanpham/".$Hinh))
            {
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move("upload/hinhanhsanpham",$Hinh);
            if($hinhanh->image !=null){
                unlink("upload/hinhanhsanpham/".$hinhanh->image);
              }
            $hinhanh->image = $Hinh;
        }
        $hinhanh->product_id = $request->SanPham;
        $hinhanh->save();
        return redirect('admin/hinhanhsanpham/danhsach')->with('thongbao','Edit thành công hình ảnh sản phẩm: '.$request->SanPham);
    }
    public function getXoa($id)
    {
          $hinhanh = HinhAnhSanPham::find($id);
          if($hinhanh->image !=null){
            unlink("upload/hinhanhsanpham/".$hinhanh->image);
          }
         
          $hinhanh->delete();
          return redirect('admin/hinhanhsanpham/danhsach')->with('thongbao','Delete thành công hình ảnh sản phẩm: '.$id);
    }
    public function postNhapExcel(Request $request)
    {
        Excel::import(new HinhAnhSanPhamImport, $request->file('file_excel')); 
        return redirect('admin/hinhanhsanpham/danhsach');
    }
    public function getXuatExcel()
    {
        return Excel::download(new HinhAnhSanPhamExport,'danh-sach-hinh-anh.xlsx'); 
    }
   
}
