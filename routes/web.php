<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@trangchu');


//Route::get('/LoginAdmin', 'AdminController@getLoginAdmin');
//Route::post('/CheckLoginAdmin', 'AdminController@postCheckLogin');
//Route::get('/LogoutAdmin', 'AdminController@CkeckLogout');
//Route::get('/ResetPassword','AdminController@getViewReset');
//Route::post('/XulyResetPass','AdminController@postXulyReset');
//Route Trang quản trị Admin
Route::group(['prefix' => 'admin'/*, 'middleware' => 'admin.login'*/], function () {

        Route::get('trangchu', 'AdminController@TrangChu');
        Route::post('/thongtincanhan/{admin_id}','UserController@postSuaThongTin');
        Route::group(['prefix' => 'danhmucsanpham', 'middleware' => 'roles.editor'], function () {
                //  admin/danhmucsanpham/danhsach
                Route::get('/danhsach', 'DanhMucSanPhamController@getDanhSach');
                Route::post('/them', 'DanhMucSanPhamController@postThem');
                Route::get('/sua/{id}', 'DanhMucSanPhamController@getSua');
                Route::post('/sua', 'DanhMucSanPhamController@postSua');
                Route::get('/xoa/{id}', 'DanhMucSanPhamController@getXoa');
                Route::get('/andanhmuc/{id}', 'DanhMucSanPhamController@getAn');
                Route::get('/hiendanhmuc/{id}', 'DanhMucSanPhamController@getHien');
                Route::get('/timkiem','DanhMucSanPhamController@getTimKiem');
        });


        Route::group(['prefix' => 'thuonghieu'/*, 'middleware' => 'roles.editor'*/], function () {
                //  admin/thuonghieu/danhsach
                Route::get('/danhsach', 'ThuongHieuController@getDanhSach');
                Route::get('/them', 'ThuongHieuController@getThem');
                Route::post('/them', 'ThuongHieuController@postThem');
                Route::get('/sua/{id}', 'ThuongHieuController@getSua');
                Route::post('/sua/{id}', 'ThuongHieuController@postSua');
                Route::get('/xoa/{id}', 'ThuongHieuController@getXoa');
                Route::get('/andanhmuc/{id}', 'ThuongHieuController@getAn');
                Route::get('/hiendanhmuc/{id}', 'ThuongHieuController@getHien');
                Route::get('/timkiem','SanPhamController@getTimKiem');
        });


        Route::group(['prefix' => 'sanpham'/*, 'middleware' => 'roles.editor'*/], function () {
                //  admin/sanpham/danhsach
                Route::get('/danhsach', 'SanPhamController@getDanhSach');
                Route::get('/them', 'SanPhamController@getThem');
                Route::post('/them', 'SanPhamController@postThem');
                Route::get('/sua/{id}', 'SanPhamController@getSua');
                Route::post('/sua/{id}', 'SanPhamController@postSua');
                Route::get('/xoa/{id}', 'SanPhamController@getXoa');
                Route::post('/nhapexcel', 'SanPhamController@postNhapExcel');
                Route::get('/xuatexcel', 'SanPhamController@getXuatExcel');
                Route::get('/timkiem','SanPhamController@getTimKiem');
        });


        Route::group(['prefix' => 'slide', 'middleware' => 'roles.editor'], function () {
                //  admin/slide/danhsach
                Route::get('/danhsach', 'SlideController@getDanhSach');
                Route::get('/them', 'SlideController@getThem');
                Route::post('/them', 'SlideController@postThem');
                Route::get('/sua/{id}', 'SlideController@getSua');
                Route::post('/sua/{id}', 'SlideController@postSua');
                Route::get('/xoa/{id}', 'SlideController@getXoa');
        });

        Route::group(['prefix' => 'hinhanhsanpham'/*, 'middleware' => 'roles.editor'*/], function () {
                //  admin/slide/danhsach
                Route::get('/danhsach', 'HinhAnhSanPhamController@getDanhSach');
                Route::get('/them', 'HinhAnhSanPhamController@getThem');
                Route::post('/them', 'HinhAnhSanPhamController@postThem');
                Route::get('/sua/{id}', 'HinhAnhSanPhamController@getSua');
                Route::post('/sua/{id}', 'HinhAnhSanPhamController@postSua');
                Route::get('/xoa/{id}', 'HinhAnhSanPhamController@getXoa');
                Route::post('/nhapexcel', 'HinhAnhSanPhamController@postNhapExcel');
                Route::get('/xuatexcel', 'HinhAnhSanPhamController@getXuatExcel');
                
        });
        Route::group(['prefix' => 'donhang'/*, 'middleware' => 'roles.editor'*/], function () {
                Route::get('/danhsach', 'DonHangController@getDanhSach');
                Route::get('/chitiet/{id}', 'DonHangController@getChiTiet');
                Route::get('/indonhang/{checkout_code}','DonHangController@getInDonHang');
                Route::get('/edit/{order_id}', 'DonHangController@getEdit');
                Route::post('/edit/{order_id}', 'DonHangController@postEdit');
                Route::get('/timkiem','DonHangController@getTimKiem');
        });


        Route::group(['prefix' => 'phivanchuyen'/*, 'middleware' => 'roles.editor'*/], function () {

                Route::get('/them', 'PhiVanChuyenController@getThem');
                Route::post('/selectpvc', 'PhiVanChuyenController@postSelect');
                Route::post('/postthem', 'PhiVanChuyenController@postThem');
                Route::post('/sua', 'PhiVanChuyenController@postSua');
                Route::get('/xoa/{id}', 'PhiVanChuyenController@getXoa');
        });

        Route::group(['prefix' => 'user'/*, ['middleware' => ['roles.admin','roles.editor']]*/], function () {
                Route::get('/danhsach', 'UserController@getDanhSach');
                Route::post('/phanquyen', 'UserController@postPhanQuyen');
                Route::get('/deleteuser/{admin_id}', 'UserController@DeleteUser');
                Route::post('/them','UserController@postThemUser');
        });
        Route::group(['prefix' => 'binhluan'/*, 'middleware' => 'roles.censorship'*/], function () {
                Route::get('/danhsach', 'BinhLuanController@getDanhSach');
                Route::post('/traloibinhluan', 'BinhLuanController@postReply');
                Route::get('/anbinhluan/{id}', 'BinhLuanController@getAn');
                Route::get('/hienbinhluan/{id}', 'BinhLuanController@getHien');
                Route::get('/xoabinhluan/{id}','BinhLuanController@getXoa');
        });
        // khách hàng
        Route::group(['prefix' => 'khachhang'/*, 'middleware' => 'roles.editor'*/], function () {
                Route::get('/danhsach', 'KhachHangController@getDanhSach');
                Route::get('/Khoa/{customer_id}', 'KhachHangController@getKhoa');
                Route::get('/Mokhoa/{customer_id}', 'KhachHangController@getMoKhoa');
                Route::get('/xoa/{customer_id}', 'KhachHangController@getXoa');
                Route::get('/timkiem','KhachHangController@getTimKiem');
        });
});
//Route trang home hiển thị sản phẩm hàng hóa
Route::group(['prefix' => 'home'], function () {
        //home/trangchu

        Route::get('/trangchu', 'PagesController@trangchu');
        Route::get('/slide', 'PagesController@Slide');
        Route::get('/loaisanpham/{category_id}', 'PagesController@loaisanpham');
        Route::get('/thuonghieu/{brand_id}', 'PagesController@thuonghieu');
        Route::get('/chitiet/{product_id}', 'PagesController@chitietsanpham');
        Route::get('/timkiem', 'PagesController@timkiem');

        //Giỏ hàng
        Route::get('/addcart/{product_id}', 'PagesController@AddCart');
        Route::get('/showcart', 'PagesController@ShowCart');
        Route::get('/deletecart/{id}', 'PagesController@DeleteCart');
        Route::get('/deleteAllCart', 'PagesController@DeleteAllCart');
        //Đăng nhập
        Route::get('/login', 'PagesController@LoginCheckout');
        //Kiểm tra đăng nhập
        Route::post('/checklogin', 'PagesController@CheckLogin');
        //Đăng ký khách hàng
        Route::post('/addcustomer', 'PagesController@AddCustomer');
        Route::post('/editcustomer/{id}', 'PagesController@EditCustomer');
        //Hiển thị thanh toán
        Route::get('/checkout', 'PagesController@Checkout')->middleware('roles.customer');
        //Lưu thông tin thanh toán
        Route::post('/savecheckout', 'PagesController@SaveCheckOut');
        //Đăng xuất
        Route::get('/logout', 'PagesController@Logout');

      
        //Trang liên hệ
        Route::get('/contact', 'PagesController@getContact');
        //Trang checkout
        Route::post('/selectPVC_home', 'PagesController@PostSelect');
        Route::post('/tinhPVC', 'PagesController@PostTinhPhi');
        Route::get('/delete_fee', 'PagesController@getDeleteFee');
        Route::get('/taikhoanKH/{id}', 'PagesController@getView')->middleware('roles.customer');
        Route::get('/khoiphucmk','PagesController@getViewResetPass');
        Route::post('/xulyreset','PagesController@postResetPass');
        //Comment trực tiếp
        Route::get('/updateGioHang', 'PagesController@getUpdateGioHang');
        Route::post('/commentsimple/{id}', 'PagesController@CommentSimple');
        //Đơn hàng của khách hàng
        Route::get('/donhang/{id}', 'PagesController@getDonHang')->middleware('roles.customer');
        Route::get('/chitietdonhang/{order_code}', 'PagesController@getChiTietDonHang')->middleware('roles.customer');
        Route::get('/huydonhang/{order_code}/id/{id}', 'PagesController@getHuyDonHang');
        Route::post('/lienhe', 'PagesController@postLienHe');
});

