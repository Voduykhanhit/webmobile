<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests;
use App\SanPham;
use App\ThuongHieu;
use App\DanhMucSanPham;
use App\Slide;
use App\HinhAnhSanPham;
use App\GiaoHang;
use App\KhachHang;
use App\ThanhToan;
use App\ChiTietHoaDon;
use App\HoaDon;
use App\MaGiamGia;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Session;
use Cart;
use App\TinhThanhPho;
use App\QuanHuyen;
use App\XaPhuongThiTran;
use App\PhiVanChuyen;
use App\BinhLuan;
use App\TraLoiBinhLuan;
session_start();


class PagesController extends Controller
{
    function __construct(){
        $slide = Slide::All();
        $thuonghieu = ThuongHieu::All();
        $danhmuc = DanhMucSanPham::All();
        $sanpham = SanPham::All();
        View::share('slide',$slide);
       View::share('thuonghieu',$thuonghieu);
        View::share('danhmuc',$danhmuc);
        View::share('sanpham',$sanpham);
       
      
    }
  public  function trangchu(){
        $productindex = SanPham::paginate(6);//controller->model
        return view('home.pages.trangchu',compact('productindex'));//controller->model
    }
   // hiển thị trang danh mục sản phẩm
  public  function loaisanpham($category_id){
        $category = DanhMucSanPham::find($category_id);
        $product = SanPham::where('category_id',$category_id)->paginate(6);

        return view('home.pages.loaisanpham',compact('category','product'));
    }
    //Hiển thị TH lên trang
   public function thuonghieu($brand_id)
    {
        $brand = ThuongHieu::find($brand_id);
        $brand_products = SanPham::where('brand_id',$brand_id)->paginate(6);
        return view('home.pages.thuonghieusanpham',compact('brand','brand_products'));
    }
    //Hiển thị CTSP lên trang
   public function chitietsanpham($product_id)
    {
        $productdetail = SanPham::find($product_id);
        $productimage = HinhAnhSanPham::where('product_id',$product_id)->take(6)->get();
        $sanphamdecu = SanPham::where('category_id',$productdetail->category_id)->whereNotIn('product_id',[$product_id])->get();
        $comment = BinhLuan::where('product_id',$product_id)->paginate(4);
        $reply = TraLoiBinhLuan::all();
        return view('home.pages.chitietsanpham',compact('productdetail','productimage','sanphamdecu','comment','reply'));
    }
    //tìm kiếm sản phẩm
  public  function timkiem(Request $request)
    {
        $tukhoa = $request->get('tukhoa');
        $productsearch = SanPham::where('product_name','like','%'.$tukhoa.'%')->orWhere('product_price','like','%'.$tukhoa.'%')->paginate(5);
        return view('home.pages.timkiem',compact('tukhoa','productsearch'));
    }
    //Thêm giỏ hàng
   public function AddCart($product_id){
        $check_quantity = SanPham::where('product_id',$product_id)->first();
        if($check_quantity->product_quantity > 0)
        {
            $product_cart = SanPham::find($product_id);
            Cart::add([
                'id' => $product_id,
                'name' => $product_cart->product_name,
                'price' => $product_cart->product_price,
                'qty' => 1,
                'weight' => 0,
                'options' => [
                    'image' => $product_cart->product_image
                ]
            ]);
            $count = Cart::count();
            $session = Cart::content();
            Session::put('Cart',$session);
             return redirect('home/showcart');
        }else{
            return redirect()->back()->with('thongbaoloi','Sản phẩm đang trong tình trạng hết hạn mời bạn chọn sản phẩm khác!!!');
        }
       
     

    }
    public function ShowCart(){
        $data['items'] = Cart::content();
        $data['total'] = Cart::total();
        
        
        return view('home.pages.giohang',$data);
    }

    public function DeleteCart($id)
    {   

            Cart::remove($id);
            return redirect()->back();
           
    }
    
    //Chỉnh sửa số lượng trong giỏ hàng
   public function getUpdateGioHang(Request $request){
       $CheckSp = SanPham::find($request->id);
       $qty = Cart::get($request->rowId);
       if($CheckSp->product_quantity < $request->qty)
       {
           return redirect()->back();
       }else{
            Cart::update($request->rowId,$request->qty);
           }
       
       }
       
   
   public function DeleteAllCart(){
   
     Cart::destroy();
     Session::forget('Cart');
     Session::forget('fee');
     return redirect()->back();
 }
    
   
    //Hiển thị form đăng nhập
    public function LoginCheckout(){
        return view('home.pages.login');
    }
    //Đăng nhập và kiểm tra đăng nhập từ tài khoản khách hàng đã đăng ký
    public function CheckLogin(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        $result = KhachHang::where('customer_email',$email)->where('customer_password',$password)->first();
        if($result)
        {
            if($result->customer_status==0)
            {
              return redirect()->back()->with('thongbaoloi','Tài khoản đã bị khóa hãy liên hệ quản trị viên để được khắc phục!!!');
            }else{
                Session::put('customer_id',$result->customer_id);
                Session::put('customer_email',$result->customer_email);
                Session::put('customer_name',$result->customer_name);
                return redirect('home/checkout');
            }
          
        }else{
            return redirect('home/login')->with('thongbaoloi','Sai tên tài khoản hoặc mật khẩu!!!');
        }
    }
    //Đăng ký tài khoản khách hàng
    public function AddCustomer(Request $request)
    {
        $this->validate($request,
      [
        'Ten'=>'required',
        'Email'=>'required|unique:tbl_customers,customer_email|min:5',
        'Password'=>'required|min:5|max:30',
        'PasswordAgain'=>'required|min:5|max:30|same:Password',
        'Phone'=>'required|min:10|max:30'

      ],
      [
        'Ten.required'=>'Tên không được bỏ trống',
        'Email.required'=>'Email không được bỏ trống',
        'Email.unique'=>'Email này đã được tạo',
        'Email.min'=>'Email phải từ 5 ký tự trở lên',
        'Password.required'=>'Mật khẩu không được bỏ trống',
        'Password.min'=>'Mật khẩu phải từ 5 ký tự trở lên',
        'Password.max'=>'Mật khẩu tối đa 30 ký tự',
        'PasswordAgain.required'=>'Mật khẩu không được bỏ trống',
        'PasswordAgain.min'=>'Mật khẩu phải từ 5 ký tự trở lên',
        'PasswordAgain.max'=>'Mật khẩu tối đa 30 ký tự',
        'PasswordAgain.same'=>'Mật khẩu nhập lại không đúng'
        
      ]  
    );
    $data = array();
    $data = new KhachHang;
    $data->customer_name = $request->Ten;
    $data->customer_phone = $request->Phone;
    $data->customer_email = $request->Email;
    $data->customer_password = md5($request->Password);
    $data->customer_status = 1;
    $data->save();
    Session::put('customer_id',$data->customer_id);
    Session::put('customer_email',$request->Email);
    Session::put('customer_name',$request->Ten);
   return redirect('home/checkout');


    }
    //Chỉnh sửa thông tin khách hàng
    public function EditCustomer(Request $request,$id){
        $this->validate($request,[
        'HoVaTen' => 'required',
        'Phone'=>'required|numeric|min:10',
        'XNMatKhau'=>'same:MatKhau'
        ],[
        'HoVaTen.required'=>'Họ tên không được bỏ trống!!!',
        'Phone.required'=>'Số điện thoại không được bỏ trống!!!',
        'Phone.numeric'=>'Số điện thoại phải là số!!!',
        'Phone.min'=>'Số điện thoại phải từ 10 số trở lên',
        'XNMatKhau.same'=>'Mật khẩu xác nhận không đúng!!!'
        ]
        );
        $khachhang = KhachHang::find($id);
      if($request->checkpassword == "on")
      {
        if($request->MatKhau!=NULL && $request->XNMatKhau!=NULL)
        {
            $khachhang->customer_name = $request->HoVaTen;
            $khachhang->customer_phone = $request->Phone;
            $khachhang->customer_password = md5($request->MatKhau);
            $khachhang->save();
            return redirect('home/taikhoanKH/'.$id)->with('thongbao','Chỉnh sửa thành công!!!');
        }else{
            return redirect('home/taikhoanKH/'.$id)->with('thongbaoloi','Mật khẩu không được bỏ trống');
        }
      }else{
        $khachhang->customer_name = $request->HoVaTen;
        $khachhang->customer_phone = $request->Phone;
        $khachhang->save();
        return redirect('home/taikhoanKH/'.$id)->with('thongbao','Chỉnh sửa thành công!!!');
      }
        
      

    }
    //Trang Checkout
    public function Checkout(){
        $city = TinhThanhPho::all();
        return view('home.pages.checkout',compact('city'));
    }
    public function getDeleteFee(){
        Session::forget('fee');
        return redirect()->back();
    }
    public function PostSelect(Request $request)
    {
        $data = $request->all();
        if($data['action'])
        {
            $output = '';
            if($data['action']=="TinhThanhPho"){
                $select_quan= QuanHuyen::where('matp',$data['matp'])->orderby('maqh','ASC')->get();
                $output.='<option value="0">--Chọn quận huyện--</option>';
                foreach($select_quan as $slq){
                $output.='<option value="'.$slq->maqh.'">'.$slq->name_quanhuyen.'</option>'; 
            }
                
            }else{
                $select_xa= XaPhuongThiTran::where('maqh',$data['matp'])->orderby('xaid','ASC')->get();
                $output.='<option value="0">--Chọn xã phường--</option>';
                foreach($select_xa as $slx){
                $output.='<option value="'.$slx->xaid.'">'.$slx->name_xaphuong.'</option>'; 

                }
            } 
            echo $output;  
        }
    }
    public function PostTinhPhi(Request $request)
    {
        $data = $request->all();
        if($data['matp'])
        {
            $feeship = PhiVanChuyen::where('matp',$data['matp'])->where('maqh',$data['maqh'])->where('xaid',$data['xaid'])->get();
            foreach($feeship as $fs)
            {
                Session::put('fee',$fs->fee_feeship);
                Session::save();
            }
        }
    }
    //Thông tin gửi hàng từ khách hàng
    public function SaveCheckOut(Request $request){

       
        if(Session::get('fee')!= null){
            $this->validate($request,[
                'TenNguoiNhan'=>'required|min:5|max:50',
                'DiaChi'=>'required|min:5|max:200',
                'Email'=>'required|email',
                'SoDienThoai'=>'required|numeric|min:10',
                'GhiChu'=>'required',
                'ThanhToan'=>'required'
               

            ],
            [
                'TenNguoiNhan.required'=>'Tên người nhận không được bỏ trống!!!',
                'TenNguoiNhan.min'=>'Họ và tên phải từ 5 ký tự trở lên',
                'TenNguoiNhan.max'=>'Tên tối đa 50 ký tự',
                'DiaChi.required'=>'Địa chỉ nhận hàng không được bỏ trống!!!',
                'DiaChi.min'=>'Địa chỉ phải từ 5 ký tự trở lên',
                'DiaChi.max'=>'Địa chỉ tối đa 200 ký tự',
                'Email.required'=>'Địa chỉ email không được bỏ trống',
                'Email.email'=>"Nhập sai định dạng email mời bạn nhập lại!!!",
                'SoDienThoai.required'=>'Số điện thoại không được bỏ trống!!!',
                'SoDienThoai.numeric'=>'Số điện thoại phải là số!!!',
                'SoDienThoai.min'=>'Số điện thoại phải từ 10 ký tự trở lên!!!',
                'GhiChu.required'=>'Ghí chú giao hàng không được bỏ trống!!!',
                'ThanhToan.required'=>'Bạn chưa chọn hình thức thanh toán!!!'

            ]
            );
            $shipping = new GiaoHang;
            $shipping->shipping_name= $request->TenNguoiNhan;
            $shipping->shipping_address = $request->DiaChi;
            $shipping->shipping_email = $request->Email;
            $shipping->shipping_phone = $request->SoDienThoai;
            $shipping->shipping_notes = $request->GhiChu;
            $shipping->save();
             
            $getcart = Cart::content();
            $total = Cart::total();
            $payment = new ThanhToan;
            $payment->payment_method = $request->ThanhToan;
            $payment->payment_status = "Đang xử lý";
            $payment->save();
    
            $check_code = substr(md5(microtime()),rand(0,26),5);
            $order = new HoaDon;
            $order->customer_id = Session::get('customer_id');
            $order->shipping_id = $shipping->shipping_id;
            $order->payment_id = $payment->payment_id;
            $order->order_total = $total;
            $order->order_code = $check_code;
            $order->order_status = 1;
            $order->save();
            
            $name = Session::get('customer_name');
            $email = Session::get('customer_email');
            foreach($getcart as $item)
            {
                 $order_details = new ChiTietHoaDon;
                 $update_quantity = SanPham::find($item->id);
                 $order_details->order_code = $check_code;
                 $order_details->product_id = $item->id;
                 $order_details->product_name = $item->name;
                 $order_details->product_price = $item->price;
                 $order_details->product_sales_quantity = $item->qty;
                 $update_quantity->product_quantity = ($update_quantity->product_quantity - $item->qty);
              
                
               
                
    
              
                 if(Session::get('fee')){
                $order_details->product_feeship = Session::get('fee');
                    
                 }else{
                    $order_details->product_feeship = "";
                 }
                 
                  $order_details->save();
                  $update_quantity->save();
                
            }
           
                Mail::send('emails.dathang',[
                    'getcart'=>$getcart,
                    'order'=>$order,
                ],function($mail) use($name,$email){
                    $mail->to($email);
                    $mail->from('voduykhanh03092016@gmail.com');
                    $mail->subject('Đặt hàng thành công tại'.'HTK SHOP MOBILE');
                });
                if($payment->payment_method ==1)
                {
                
                    Cart::destroy();
                    Session::forget('fee');
                    return view('home.pages.thanhcong');
                }else if ($payment->payment_method ==2)
                {
                    Cart::destroy();
                    Session::forget('fee');
                return view('home.pages.thanhcong');
                }else{
                    Cart::destroy();
                    Session::forget('fee');
                    return view('home.pages.thanhcong');
                }
            }else{
            return redirect()->back()->with('thongbaoloi','Bạn chưa chọn phí vận chuyển, mời bạn lựa chọn!!!');
        }
      

     
    }
    // đăng xuất tài khoản khách hàng
    public function Logout(){
        Session::flush();
        return redirect('home/login');
    }
    
    //Xóa toàn bộ giỏ hàng
    
    public function getContact()
    {
        return view('home.pages.lienhe');
    }
   //Bình luận
    //Comment không đăng nhập
    public function CommentSimple(Request $request,$id)
    {
        $product_id = $id;

        $this->validate($request,[
            'Ten' =>'required',
            'NoiDung'=>'required',
            'Email'=>'required'
        ],[
            'Ten.required'=>'Tên không được bỏ trống',
            'NoiDung.required'=>'Nội dung bình luận không được bỏ trống',
            'Email.required'=>'Email không được bỏ trống'
        ]);

        $comment = new BinhLuan;
        $comment->product_id = $product_id;
        $comment->comments_name	 = $request->Ten;
        $comment->comments_email = $request->Email;
        $comment->comments_content = $request->NoiDung;
        $comment->comments_status = 1;
        $comment->save();

        return redirect("home/chitiet/". $product_id."");


    }
    //View thông tin khách hàng
    public function getView($id)
    {
        $khachhang = KhachHang::find($id);
        return view('home.pages.khachhang',compact('khachhang'));
    }
    //View đơn hàng của chính khách hàng
    public function getDonHang($id){
        $donhang = HoaDon::where('customer_id',$id)->get();
        return view('home.pages.donhang',compact('donhang'));
    }
    //Chi tiết đơn hàng
    public function getChiTietDonHang($order_code)
    {
        $chitiethoadon = ChiTietHoaDon::where('order_code',$order_code)->get();
        $hoadon = HoaDon::where('order_code',$order_code)->get();
        foreach($hoadon as $hd)
        {
            $customer_id = $hd->customer_id;
            $shipping_id = $hd->shipping_id;
            $payment_id = $hd->payment_id;
        }
        $khachhang = KhachHang::where('customer_id',$customer_id)->first();
        $shipping = GiaoHang::where('shipping_id',$shipping_id)->first();
        $payment = ThanhToan::where('payment_id',$payment_id)->first();
        $donhang = HoaDon::where('order_code',$order_code)->first();
       
        return view('home.pages.chitietdonhang',compact('donhang','chitiethoadon','khachhang','shipping','payment'));
    }
    public function getHuyDonHang($order_code,$id){
        $donhang = HoaDon::where('order_code',$order_code)->first();

        $donhang->order_status = 3;
        $donhang->save();

        return redirect('home/donhang/'.$id)->with('thongbao','Hủy đơn hàng thành công!!!');
    }
    public function postLienHe(Request $request){
        $noidung = $request->NoiDung;
        $ten = $request->Ten;
        $email = $request->Email;
        $tieude = $request->TieuDe;
        Mail::send('emails.lienhe',[
            'noidung'=>$noidung,
            'ten'=>$ten,
            'email'=>$email
        ],function($mail) use($email,$tieude){
            $mail->to('voduykhanh03092016@gmail.com');
            $mail->subject($tieude);
        });
        return redirect()->back()->with('thongbao','Gửi mail thành công!!!');
    }
    public function getViewResetPass(){
        return view('home.pages.resetpassword');
    }
    public function postResetPass(Request $request){
        $this->validate($request,
        [
            'Email'=>'required|email'
        ],
        [
            'Email.required'=>'Email không được bỏ trống!!!',
            'Email.email'=>'Bạn phải nhập đúng định đang Email'
        ]);
        $reset = KhachHang::where('customer_email',$request->Email)->first();
        if($reset){
            $makhoiphuc = Str::random(6);
            $reset->customer_password = md5($makhoiphuc);
            $email = $request->Email;
            $reset->save();
            Mail::send('emails.resetpass',[
                'MaKhoiPhuc'=>$makhoiphuc,
                'TenNguoiDung'=>$reset->customer_name
             ],function($mail) use($email){
                 $mail->to($email);
                 $mail->from('voduykhanh03092016@gmail.com');
                 $mail->subject('Khôi phục mật khẩu của bạn'.'HTK SHOP MOBILE');
             });
             return redirect('/home/khoiphucmk')->with('thongbao','Khôi phục thành công bạn hãy kiểm tra lại Email!!');
            }else{
            return redirect('/home/khoiphucmk')->with('thongbaoloi','Không tìm thấy email trong tài khoản!!!');
        }
    }
    
}
