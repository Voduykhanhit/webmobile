<?php

namespace App\Http\Controllers;
use App\Quyen;
use App\Admin;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getDanhSach(){
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('admin.user.lietke',compact('admin'));

    }
    public function postPhanQuyen(Request $request)
    {
        if(Auth::id()==$request->admin_id)
        {
            return redirect()->back()->with('thongbao','Bạn không được phân quyền chính mình');
        }
       
       // $data = $request->all();
        $user = Admin::where('admin_email',$request->admin_email)->first();
        $user->roles()->detach();

        if($request->admin_role)
        {
            $user->roles()->attach(Quyen::where('roles_name','=','Admin')->first());
        }
        if($request->editor_role)
        {
            $user->roles()->attach(Quyen::where('roles_name','=','NhanVienQuanLy')->first());
        }
        if($request->censorship_role)
        {
             $user->roles()->attach(Quyen::where('roles_name','=','NhanVienHoTro')->first());
        }
        return redirect()->back()->with('thongbao','Cấp quyền cho user thành công');
    }
    public function DeleteUser($admin_id)
    {
        if(Auth::id()==$admin_id)
        {
            return redirect()->back()->with('thongbao','Bạn không được xóa chính mình');
        }else{
            $user = Admin::find($admin_id);
            if($user)
            {
                $user->roles()->detach();
                $user->delete();
            }
            return redirect()->back()->with('thongbao','Xóa User thành công!!!');
           
        }
        

    }
    public function postThemUser(Request $request){
        $this->validate($request,
        [
            'Ten'=>'required|min:5',
            'TaiKhoan'=>'required|unique:tbl_admin,admin_email|email|min:5',
            'SoDienThoai'=>'required|numeric',
            'MatKhau'=>'required',
            'XacNhanMatKhau'=>'required|same:MatKhau'
        ],
        [
            'Ten.required'=>'Tên không được bỏ trống',
            'Ten.min'=>'Tên phải từ 5 ký tự trở lên',
            'TaiKhoan.required'=>'Tài khoản không được bỏ trống',
            'TaiKhoan.unique'=>'Tài khoản đã tồn tại mời bạn nhập tài khoản khác',
            'TaiKhoan.email'=>'Bạn phải nhập đúng định dạng Email',
            'TaiKhoan.min'=>'Tài khoản bắt buộc từ 5 ký tự trở lên',
            'SoDienThoai.required'=>'Số điện thoại không được bỏ trống!!!',
            'SoDienThoai.numeric'=>'Số điện thoại phải là số',
            'MatKhau.required'=>'Mật khẩu không được bỏ trống',
            'MatKhau.min'=>'Mật khẩu từ 5 ký tự trở lên mời bạn nhập lại',
            'XacNhanMatKhau.same'=>'Mật khẩu nhập lại không đúng!!!'
        ]
    );
        $quantri = new Admin();
        $quantri->admin_name = $request->Ten;
        $quantri->admin_phone = $request->SoDienThoai;
        $quantri->admin_email = $request->TaiKhoan;
        $quantri->admin_password = bcrypt($request->MatKhau);
       
        $quantri->save();
        return redirect('admin/user/danhsach')->with('thongbao','Thêm người dùng thành công!!!');
        
        
    }
    public function postSuaThongTin(Request $request,$admin_id){
        $this->validate($request,
        [
            'Ten'=>'required|min:5',
            'SoDienThoai'=>'required|numeric',
            'XacNhanMatKhau'=>'same:MatKhau'
        ],
        [
            'Ten.required'=>'Tên không được bỏ trống',
            'Ten.min'=>'Tên phải từ 5 ký tự trở lên',
            'SoDienThoai.required'=>'Số điện thoại không được bỏ trống!!!',
            'SoDienThoai.numeric'=>'Số điện thoại phải là số',
            'XacNhanMatKhau.same'=>'Mật khẩu nhập lại không đúng!!!'
        ]
        );
        if($request->checkpassword=='on'){
            if($request->MatKhau != NULL && $request->XacNhanMatKhau !=NULL){
                $admin = Admin::find($admin_id);
                $admin->admin_name = $request->Ten;
                $admin->admin_phone = $request->SoDienThoai;
                $admin->admin_password = bcrypt($request->MatKhau);
                $admin->save();
                return redirect('admin/trangchu')->with('thongbaotc','Chỉnh sửa thông tin thành công!!!');
            }else{
                return redirect('admin/trangchu')->with('thongbaoloimodal','Mật khẩu không được bỏ trống!!!');
            }
        }else{
            $admin = Admin::find($admin_id);
            $admin->admin_name = $request->Ten;
            $admin->admin_phone = $request->SoDienThoai;
            $admin->save();
            return redirect('admin/trangchu')->with('thongbaotc','Chỉnh sửa thông tin thành công');
        }
    }
}
