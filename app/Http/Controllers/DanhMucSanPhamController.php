<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SanPham;
use App\ThuongHieu;
use App\DanhMucSanPham;
use Illuminate\Support\Facades\DB;

class DanhMucSanPhamController extends Controller
{
    public function getDanhSach()
    {
            $danhmuc = DanhMucSanPham::paginate(5);
            return view('admin.danhmucsanpham.danhsach',compact('danhmuc'));
           
    }
    public function getAn($id)
    {
        $dm = DanhMucSanPham::find($id);
        $dm->category_status = 1;
        $dm->save();
       return redirect()->back()->with('thongbao','Kích hoạt danh mục sản phẩm!!!');
    }
    public function getHien($id){
        $dm = DanhMucSanPham::find($id);
        $dm->category_status = 0;
        $dm->save();

      
       return redirect()->back()->with('thongbao','Tắt danh mục sản phẩm thành công!!!');
    }
    public function postThem(Request $request)
    {
      $validate = $this->validate($request,
        [
                'Ten' => 'required|unique:tbl_category_product,category_name|min:3|max:30',
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
        $danhmuc = new DanhMucSanPham;
        $danhmuc->category_name = $request->Ten;
        $danhmuc->category_desc = $request->NoiDung;
        $danhmuc->category_status = $request->TrangThai;
        $danhmuc->save();
        return response(['mes'=>'Thêm thành công']);
    }
   
    public function getSua($id)
    {
            $danhmuc = DanhMucSanPham::find($id);
            return response()->json(['data'=>$danhmuc]);
            //return view('admin.danhmucsanpham.sua',compact('danhmuc'));
    }
    public function postSua(Request $request)
    {
        $this->validate($request,
        [
                'Ten' => 'required|unique:tbl_category_product,category_name,'.$request->IdDanhMuc.',category_id|min:3|max:30',
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
        $danhmuc = DanhMucSanPham::find($request->IdDanhMuc);
        $danhmuc->category_name = $request->Ten;
        $danhmuc->category_desc = $request->NoiDung;
        $danhmuc->category_status = $request->TrangThai;
        $danhmuc->save();
        return response(['mes'=>'Sửa thành công!!!']);
        //return redirect('admin/danhmucsanpham/danhsach')->with('thongbao','Edit thành công: '.$request->Ten);
        
    }
    public function getXoa($id)
    {
        $danhmuc = DanhMucSanPham::find($id);
        $danhmuc->delete();
        return redirect('admin/danhmucsanpham/danhsach')->with('thongbao','Delete thành công danh mục: '.$id);
    }
    public function getTimKiem(Request $request)
    {
        $tukhoa = $request->get('tukhoa');
        $danhmuc = DanhMucSanPham::where('category_name','like','%'.$tukhoa.'%')->orWhere('category_id','like','%'.$tukhoa.'%')->paginate(5);
        return view('admin.danhmucsanpham.timkiem',compact('tukhoa','danhmuc'));
    }



}

