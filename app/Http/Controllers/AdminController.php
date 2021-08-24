<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Admin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


session_start();

class AdminController extends Controller
{
  
    public function getLoginAdmin()
    {
        return view('admin.login');
    }
    public function getRegisACAdmin()
    {
        return view('admin.regisaccountAdmin');
    }
    public function getViewReset(){
        return view('admin.resetpassword');
    }
    public function trangchu(){
        $this->AuthLogin();
        return view('admin.layout.index');
    }
    public function postCheckLogin(Request $request)
    {
        $this->validate($request,
        [
            'Email'=>'required',
            'Password'=>'required'
        ],
        [
            'Email.required'=>'Email không được bỏ trống',
            'Password.required'=>'Mật khẩu không được bỏ trống'
        ]);
        if(Auth::attempt(['admin_email'=>$request->Email,'admin_password'=>$request->Password]))
        {  
            Session::put('admin_id',Auth::id());
            return redirect('admin/trangchu');
        }else{
            return redirect('LoginAdmin')->with('thongbao','Sai tên tài khoản hoặc mặt khẩu mời bạn đăng nhập lại!!!!');
        }
    }
    //put lưu giá trị mớI vào session push session mảng session flush xoá hết session flash 1 yêu cầu
   public function postCheckRegisAdmin(Request $request)
   {
       $this->validate($request,
       [
        'Name'=> 'required|min:4:max:30',
        'Email'=>'required|unique:tbl_admin,admin_name|min:4:max:30',
          'Phone' =>'required',
        'Password' =>'required'
       ],
       [
        'Name.required'=>'Tên không được bỏ trống',
        'Name.min'=>'Tên phải từ 4 ký tự trở lên',
        'Name.max'=>'Tên tối đa 30 ký tự',
        'Email.required'=>'Tài khoản không được bỏ trống',
        'Email.unique'=>'Tài khoản đã tồn tại mời bạn nhập tài khoản khác',
        'Email.min'=>'tài khoản phải từ 4 ký tự trở lên',
        'Email.max' => 'Tài khoản tối đa 30 ký tự',
        'Phone.required'=>'số điện thoại không được bỏ trống',
        'Password.required'=>'Password không được bỏ trống'
    ]);
        $adminlogin = new Admin;
        $adminlogin->admin_email = $request->Email;
        $adminlogin->admin_password = bcrypt($request->Password);
        $adminlogin->admin_name = $request->Name;
        $adminlogin->admin_phone = $request->Phone;
        $adminlogin->save();
        return redirect('regisAccountAdmin')->with('thongbao','đăng ký thành công!!!');
   }
   public function AuthLogin(){
       $admin_id = Auth::id();
       if($admin_id)
       {
           return Redirect::to('admin/trangchu');
       }else{
           return Redirect::to('LoginAdmin');
       }
   }
   public function CkeckLogout(){
       Auth::logout();
       return Redirect::to('LoginAdmin');
   }
   public function postXulyReset(Request $request){
       $this->validate($request,
       [
            'Email'=>'required|email'
       ],
       [
            'Email.required'=>'Email khôi phục không được bỏ trống',
            'Email.email'=>'Bạn phải nhập đúng định dạng email @'
       ]
       );
        $reset = Admin::where('admin_email',$request->Email)->first();
        
        if($reset != NULL){
            $mareset = Str::random(4);
             $reset->admin_password = bcrypt($mareset);
             $reset->save();
             $email = $request->Email;
            Mail::send('emails.resetpass',[
               'MaKhoiPhuc'=>$mareset,
               'TenNguoiDung'=>$reset->admin_name
            ],function($mail) use($email){
                $mail->to($email);
                $mail->from('voduykhanh03092016@gmail.com');
                $mail->subject('Khôi phục mật khẩu của bạn'.'HTK SHOP MOBILE');
            });
            return redirect('/ResetPassword')->with('thongbao','Khôi phục tài khoản thành công mời bạn kiểm tra lại Email của mình');
        }else{
            return redirect('/ResetPassword')->with('thongbaoloi','Email không tồn tại trong tài khoản Admin');
        }
    }
}




