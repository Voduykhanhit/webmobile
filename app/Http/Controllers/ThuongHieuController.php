<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\SanPham;
use App\ThuongHieu;
use App\DanhMucSanPham;
class ThuongHieuController extends Controller
{
    public function getDanhSach()
    {
            $thuonghieu = ThuongHieu::paginate(5);
            return view('admin.thuonghieu.danhsach',compact('thuonghieu'));
    }

    public function getAn($id)
    {
        $an = ThuongHieu::find($id);
        $an->brand_status = 1;
        $an->save();
       return redirect('admin/thuonghieu/danhsach')->with('thongbao','Kích hoạt danh mục sản phẩm thành công!!!');
    }
    public function getHien($id){
        $an = ThuongHieu::find($id);
        $an->brand_status = 0;
        $an->save();
        return redirect('admin/thuonghieu/danhsach')->with('thongbao','Không kích hoạt danh mục sản phẩm thành công!!!');
    }
    public function getThem()
    {
            return view('admin/thuonghieu/them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
        [
                'Ten' => 'required|unique:tbl_brand,brand_name|min:3|max:30',
                'NoiDung'=>'required',
                'TrangThai'=>'required'
        ],
        [
            'Ten.required'=>'Tên danh mục không được bỏ trống',
            'Ten.unique'=>'Tên đã tồn tại trong danh mục',
            'Ten.min'=>'Tên phải từ 3 ký tự trở lên',
            'Ten.max'=>'Tên tối đa 30 ký tự',
            'NoiDung.required'=>'Nội dung không được bỏ trống',
            'TrangThai.required'=>'Bạn chưa chọn trạng thái'
        ]);
        $thuonghieu = new ThuongHieu;
        $thuonghieu->brand_name = $request->Ten;
        $thuonghieu->brand_desc = $request->NoiDung;
        $thuonghieu->brand_status = $request->TrangThai;
        $thuonghieu->save();
        return redirect('admin/thuonghieu/danhsach')->with('thongbao','Thêm thành công thương hiệu: '.$request->Ten);
    }

    public function getSua($id)
    {
        $thuonghieu = ThuongHieu::find($id);
        return view('admin.thuonghieu.sua',compact('thuonghieu'));
    }
    public function postSua(Request $request,$id)
    {
        $this->validate($request,
        [
                'Ten' => 'required|unique:tbl_brand,brand_name,'.$id.',brand_id|min:3|max:30',
                'NoiDung'=>'required',
                'TrangThai'=>'required'
        ],
        [
            'Ten.required'=>'Tên thương hiệu không được bỏ trống',
            'Ten.unique'=>'Tên đã tồn tại trong thương hiệu',
            'Ten.min'=>'Tên phải từ 3 ký tự trở lên',
            'Ten.max'=>'Tên tối đa 30 ký tự',
            'NoiDung.required'=>'Nội dung không được bỏ trống',
            'TrangThai.required'=>'Bạn chưa chọn trạng thái'
        ]);
        $thuonghieu = ThuongHieu::find($id);
        $thuonghieu->brand_name = $request->Ten;
        $thuonghieu->brand_desc = $request->NoiDung;
        $thuonghieu->brand_status = $request->TrangThai;
        $thuonghieu->save();
        return redirect('admin/thuonghieu/danhsach')->with('thongbao','Edit thành công thương hiệu: '.$request->Ten);
          
    }
    public function getXoa($id)
    {
            $thuonghieu = ThuongHieu::find($id);
            $thuonghieu->delete();
            return redirect('admin/thuonghieu/danhsach')->with('thongbao','Delete thành công thương hiệu: '.$id);
    }
}
