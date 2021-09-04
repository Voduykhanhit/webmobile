<?php

namespace App\Http\Controllers;
use App\KhachHang;
use Illuminate\Http\Request;

class KhachHangController extends Controller
{
    public function getDanhSach(){
        $khachhang = KhachHang::paginate(5);
        return view('admin.khachhang.danhsach',compact('khachhang'));
    }
    public function getKhoa($customer_id){
            $khachhang = KhachHang::find($customer_id);
            $khachhang->customer_status = 0;
            $khachhang->save();
            return redirect()->back()->with('thongbao','Khóa tài khoản khách hàng '.$khachhang->customer_name.' thành công');
    }
    public function getMoKhoa($customer_id){
        $khachhang = KhachHang::find($customer_id);
        $khachhang->customer_status = 1;
        $khachhang->save();
        return redirect()->back()->with('thongbao','Mở khóa tài khoản khách hàng '.$khachhang->customer_name.' thành công');

    }
    public function getXoa($customer_id){
        $khachhang = KhachHang::find($customer_id);
        $khachhang->delete();
        return redirect()->back()->with('thongbao','Xóa thông tin khách hàng'.$khachhang->customer_name.' thành công');
    }
    public function getTimKiem(Request $request)
    {
        dd($request->tukhoa);
        $tukhoa = $request->get('tukhoa');
        $khachhang = KhachHang::where('customer_name','like','%'.$tukhoa.'%')->paginate(5);
        return view('admin.khachhang.timkiem',compact('tukhoa','khachhang'));
    }
}
