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
use Illuminate\Support\Facades\DB;
use Session;
use Cart;
use PDF;
session_start();

class DonHangController extends Controller
{
    public function getDanhSach(){
        $donhang = HoaDon::orderBy('created_at','DESC')->paginate(5);
        return view('admin.donhang.danhsach',compact('donhang'));
    }
    public function getChiTiet($id){
      
        $chitiethoadon = ChiTietHoaDon::where('order_code',$id)->get();
        $hoadon = HoaDon::where('order_code',$id)->get();
        foreach($hoadon as $hd)
        {
            $customer_id = $hd->customer_id;
            $shipping_id = $hd->shipping_id;
            $payment_id = $hd->payment_id;
        }
        $khachhang = KhachHang::where('customer_id',$customer_id)->first();
        $shipping = GiaoHang::where('shipping_id',$shipping_id)->first();
        $payment = ThanhToan::where('payment_id',$payment_id)->first();

       
      
       
        return view('admin.donhang.chitiet',compact('chitiethoadon','khachhang','shipping','payment'));
    }
    public function getInDonHang($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $chitiethoadon = ChiTietHoaDon::where('order_code',$checkout_code)->get();
        $hoadon = HoaDon::where('order_code',$checkout_code)->get();
        foreach($hoadon as $hd)
        {
            $customer_id = $hd->customer_id;
            $shipping_id = $hd->shipping_id;
            $payment_id = $hd->payment_id;
        }
        $khachhang = KhachHang::where('customer_id',$customer_id)->first();
        $shipping = GiaoHang::where('shipping_id',$shipping_id)->first();
        $payment = ThanhToan::where('payment_id',$payment_id)->first();

        

       

        $output='';

        $output .='
            <style>
            body{
                font-family:DejaVu Sans;


            }
            .table-styling{
                border-collapse: collapse;
                border: 1px solid black;
               width:700px;
                border-spacing: 0;
                text-align:center;
            }
           .table-styling th{
            border-right: 1px solid black;
            text-align:center;
            }
            .table-styling tr td{
                border: 1px solid black;
            }
            </style>
            <h2><center>Cửa Hàng Điện Thoại HKT SHOP MOBILE</center></h2>
            <p>THÔNG TIN ĐẶT HÀNG</p>
        <table class="table-styling">
                        <thead>
                            <tr>
                                    <th>Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>';
                        
    $output.='
                            <tr>
                                <td>'.$khachhang->customer_name.' </td>
                                <td>'.$khachhang->customer_phone.' </td>
                                <td>'.$khachhang->customer_email.' </td>
                            </tr>';
    $output.='
                        </tbody>
        </table>
        <p>THÔNG TIN VẬN CHUYỂN</p>
        <table class="table-styling">
                        <thead>
                            <tr>
                                    <th>Tên người nhận</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Ghi chú giao hàng</th>
                            </tr>
                        </thead>
                        <tbody>';
                        
    $output.='
                            <tr>
                                <td>'. $shipping->shipping_name.' </td>
                                <td>'. $shipping->shipping_phone.' </td>
                                <td>'. $shipping->shipping_address.' </td>
                                <td>'. $shipping->shipping_notes.' </td>
                            </tr>';
    $output.='
                        </tbody>
        </table>
        <p>SẢN PHẨM MUA</p>
        <table class="table-styling">
                        <thead>
                            <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Phí giao hàng</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>';
                        $tong=  0;
                        
                        
                        foreach($chitiethoadon as $sp){
                            $subtotal = $sp->product_price*$sp->product_sales_quantity;
                            $tong += $subtotal;
    $output.='
                            <tr>
                                <td>'. $sp->product_name.' </td>
                                <td>'. number_format($sp->product_price).'đ'.' </td>
                                <td>'. $sp->product_ok.' </td>
                                <td>'. $sp->product_feeship.'đ</td>
                                <td>'. $sp->product_sales_quantity.' </td>
                                <td>'. number_format($subtotal).'đ'.' </td>
                            </tr>';
                        }
                       
    $output.='
                        <tr>
                            <td colspan="6">
                                <p>Phí ship:'.number_format($sp->product_feeship).'đ  </p>
                                <p>Thanh toán: '. number_format($tong +$sp->product_feeship).'đ'.' </p>
                            </td>
                        </tr>
    ';
    $output.='
                        </tbody>
        </table>
        
        <table>
                        <thead>
                            <tr>
                            <th width="200px">Người lập phiếu</th>
                            <th width="800px">Người nhận</th>
                            </tr>
                        </thead>
                        <tbody>';
    $output.='                  <tr>
                                    
                                    <td align="center">'.$shipping->created_at->format('d/m/Y').'<br>Ký tên</td>
                                    <td align="center">'. $shipping->shipping_name.'</td>
                                </tr>';
    $output.='
                        </tbody>
        </table>
        ';
        return $output;
    }
    public function getEdit($order_id)
    {
        $order = HoaDon::find($order_id);
        return view('admin.donhang.sua',compact('order'));
    }
    public function postEdit(Request $request,$order_id)
    {
        $this->validate($request,
        [
            'TrangThai'=>'required'
        ],
        [
            'TrangThai.required'=>'Bạn chưa lựa chọn trạng thái'
        ]
        );
        $hoadon = HoaDon::find($order_id);
        $hoadon->order_status = $request->TrangThai;
        $hoadon->save();

        return redirect('admin/donhang/danhsach')->with('thongbao','Chỉnh sửa trạng thái đơn hàng '.$hoadon->order_code.' thành công');
    }
    
}
