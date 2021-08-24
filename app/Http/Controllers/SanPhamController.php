<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SanPham;
use App\ThuongHieu;
use App\DanhMucSanPham;
use App\HinhAnhSanPham;
use App\Imports\SanPhamImport;
use App\Exports\SanPhamExport;
use Illuminate\Support\Facades\DB;
use Excel;


class SanPhamController extends Controller
{
    public function getDanhSach(){
        $sanpham = SanPham::orderBy('product_id','DESC')->paginate(5);
        return view('admin.sanpham.danhsach',compact('sanpham'));
    }
    public function getAn($id)
    {
       DB::table('tbl_product')->where('product_id',$id)->update(['product_status'=>1]);
       return redirect('admin/sanpham/danhsach')->with('thongbao','Kích hoạt danh mục sản phẩm thành công!!!');
    }
    public function getHien($id){
        DB::table('tbl_product')->where('product_id',$id)->update(['product_status'=>0]);
        return redirect('admin/sanpham/danhsach')->with('thongbao','Không kích hoạt danh mục sản phẩm thành công!!!');
    }

    public function getThem()
    {
            $danhmuc = DanhMucSanPham::All();
            $thuonghieu = ThuongHieu::All();
            return view('admin.sanpham.them',compact('danhmuc','thuonghieu'));
    }

    public function postThem(Request $request)
    {
            $sanpham = new SanPham;
            $this->validate($request,
            
            [
            'Ten'=>'required|unique:tbl_product,product_name|min:3|max:30',
            'DanhMuc'=>'required',
            'ThuongHieu'=>'required',
            'SoLuong'=>'required|numeric',
            'MoTa'=>'required',
            'NoiDung'=>'required',
            'Gia'=>'required',
            'TrangThai'=>'required',
            ],
            [
            'Ten.required'=>'Tên sản phẩm không được bỏ trống',
            'Ten.unique'=>'Tên sản phẩm đã tồn tại trong CSDL',
            'Ten.min'=>'Tên phải từ 3 ký tự trở lên',
            'Ten.max'=>'Tên tối đa 30 ký tự',
            'DanhMuc.required'=>'Bạn phải lựa chọn danh mục',
            'ThuongHieu.required'=>'Bạn phải lựa chọn thương hiệu',
            'SoLuong.required'=>'Số lượng không được bỏ trống',
            'SoLuong.numeric'=>'Số lượng phải là số',
            'Mota.required'=>'Mô tả không được bỏ trống',
            'NoiDung.required'=>'Nội dung không được bỏ trống',
            'Gia.required'=>'Giá không được bỏ trống',
            'TrangThai.required'=>'Bạn phải lựa chọn trạng thái'
            ]
        );
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'png' && $duoi != 'jpg' && $duoi!='jpeg')
            {
                return redirect('admin/sanpham/them')->with('thongbaoloi','Bạn phải thêm ảnh có đuôi là JPG hoặc JPEG hoặc PNG');

            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists("upload/sanpham/".$Hinh))
            {
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move("upload/sanpham",$Hinh);
            $sanpham->product_image = $Hinh;
        }else{
            $sanpham->product_image = "";
        }
        $sanpham->product_name = $request->Ten;
        $sanpham->category_id = $request->DanhMuc;
        $sanpham->brand_id = $request->ThuongHieu;
        $sanpham->product_quantity = $request->SoLuong;
        $sanpham->product_desc = $request->MoTa;
        $sanpham->product_content = $request->NoiDung;
        $sanpham->product_price = $request->Gia;
        $sanpham->product_status = $request->TrangThai;
        $sanpham->save();

        return redirect('admin/sanpham/danhsach')->with('thongbao','Thêm thành công sản phẩm: '.$request->Ten);
    }

    public function getSua($id)
    {
            $sanpham = SanPham::find($id);
            $danhmuc = DanhMucSanPham::all();
            $thuonghieu = ThuongHieu::all();
            return view('admin.sanpham.sua',compact('sanpham','danhmuc','thuonghieu'));
    }
    public function postSua(Request $request,$id)
    {
        $sanpham = SanPham::find($id);
        $this->validate($request,
            
            [
            'Ten'=>'required|min:3|max:30',
            'DanhMuc'=>'required',
            'ThuongHieu'=>'required',
            'SoLuong'=>'required|numeric',
            'MoTa'=>'required',
            'NoiDung'=>'required',
            'Gia'=>'required',
            'TrangThai'=>'required',
            ],
            [
            'Ten.required'=>'Tên sản phẩm không được bỏ trống',
            'Ten.min'=>'Tên phải từ 3 ký tự trở lên',
            'Ten.max'=>'Tên tối đa 30 ký tự',
            'DanhMuc.required'=>'Bạn phải lựa chọn danh mục',
            'ThuongHieu.required'=>'Bạn phải lựa chọn thương hiệu',
            'SoLuong.required'=>'Số lượng không được bỏ trống',
            'SoLuong.numeric'=>'Số lượng phải là số',
            'Mota.required'=>'Mô tả không được bỏ trống',
            'NoiDung.required'=>'Nội dung không được bỏ trống',
            'Gia.required'=>'Giá không được bỏ trống',
            'TrangThai.required'=>'Bạn phải lựa chọn trạng thái'
            ]
        );
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
           if($duoi !='jpg' && $duoi!='png' && $duoi!='jpeg')
           {
               return redirect('admin/sanpham/sua')->with('thongbaoloi','Bạn phải thêm hình có đuôi là JPG AND PNG AND JPEG');

           }
           $name = $file->getClientOriginalName();
           $Hinh = Str::random(4)."_".$name;
           while(file_exists("upload/sanpham/".$Hinh))
           {
               $Hinh = Str::random(4)."_".$name;

           }
           $file->move("upload/sanpham",$Hinh);
           if($sanpham->product_image != null)
           {
            unlink("upload/sanpham/".$sanpham->product_image);
           }
           
           $sanpham->product_image = $Hinh;
            
        }
        $sanpham->product_name = $request->Ten;
        $sanpham->category_id = $request->DanhMuc;
        $sanpham->brand_id = $request->ThuongHieu;
        $sanpham->product_quantity = $request->SoLuong;
        $sanpham->product_desc = $request->MoTa;
        $sanpham->product_content = $request->NoiDung;
        $sanpham->product_price = $request->Gia;
        $sanpham->product_status = $request->TrangThai;
        $sanpham->save();
        return redirect('admin/sanpham/danhsach')->with('thongbao','Edit thành công sản phẩm: '.$request->Ten);

    }
    public function getXoa($id)
    {
            $sanpham = SanPham::find($id);
            if($sanpham->product_image != null){
                unlink("upload/sanpham/".$sanpham->product_image);
            }
           
            $sanpham->delete();
            return redirect('admin/sanpham/danhsach')->with('thongbao','Delete thành công sản phẩm: '.$id);
    }
    public function postNhapExcel(Request $request)
    {
        Excel::import(new SanPhamImport, $request->file('file_excel')); 
        return redirect('admin/sanpham/danhsach');
    }
    public function getXuatExcel()
    {
        return Excel::download(new SanPhamExport,'danh-sach-san-pham.xlsx'); 
    }
    public function getTimKiem(Request $request){
        $tukhoa = $request->get('tukhoa');
        $sanpham = SanPham::where('product_name','like','%'.$tukhoa.'%')->orWhere('product_price','like','%'.$tukhoa.'%')->paginate(5);
        return view('admin.sanpham.timkiem',compact('tukhoa','sanpham'));
    }
}
