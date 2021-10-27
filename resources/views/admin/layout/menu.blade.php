<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                //@hasrole(['NhanVienQuanLy','Admin'])
                <li class="sub-menu">
                    <a href="">
                    <i class="fas fa-folder"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{url('/admin/danhmucsanpham/danhsach')}}"><i class="fas fa-clipboard-list"></i>Danh sách</a></li>
                    </ul>
                </li>
               
                <li class="sub-menu">
                    <a href="javascript:;">
                    <i class="fas fa-folder"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
                    <li><a href="{{url('/admin/sanpham/danhsach')}}"><i class="fas fa-clipboard-list"></i>Danh sách</a></li>
                        <li><a href="{{url('/admin/sanpham/them')}}"><i class="fas fa-plus"></i>Thêm mới</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                    <i class="fas fa-folder"></i>
                        <span>Slide quảng cáo</span>
                    </a>
                    <ul class="sub">
                    <li><a href="{{url('/admin/slide/danhsach')}}"><i class="fas fa-clipboard-list"></i>Danh sách</a></li>
                        <li><a href="{{url('/admin/slide/them')}}"><i class="fas fa-plus"></i>Thêm mới</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                    <i class="fas fa-folder"></i>
                        <span>Thương hiệu</span>
                    </a>
                    <ul class="sub">
                    <li><a href="{{url('/admin/thuonghieu/danhsach')}}"><i class="fas fa-clipboard-list"></i>Danh sách</a></li>
                        <li><a href="{{url('/admin/thuonghieu/them')}}"><i class="fas fa-plus"></i>Thêm mới</a></li>
                    </ul>
                </li>
               
              
                <li class="sub-menu">
                    <a href="javascript:;">
                    <i class="fas fa-folder"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/admin/donhang/danhsach')}}"><i class="fas fa-clipboard-list"></i>Danh sách</a></li>
                    </ul>
                </li>
                //@endhasrole
                //@hasrole(['NhanVienQuanLy','Admin'])
                <li class="sub-menu">
                    <a href="javascript:;">
                    <i class="fas fa-folder"></i>
                        <span>Hình ảnh sản phẩm </span>
                    </a>
                    <ul class="sub">
                    <li><a href="{{url('/admin/hinhanhsanpham/danhsach')}}"><i class="fas fa-clipboard-list"></i>Danh sách</a></li>
                        <li><a href="{{url('/admin/hinhanhsanpham/them')}}"><i class="fas fa-plus"></i>Thêm mới</a></li>
                    </ul>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                    <i class="fas fa-folder"></i>
                        <span>Phí vận chuyển</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/admin/phivanchuyen/them')}}"><i class="fas fa-plus"></i>Thêm và liệt kê</a></li>
                    </ul>
                </li>
                //@endhasrole
                //@hasrole(['NhanVienHoTro','Admin'])
                <li class="sub-menu">
                    <a href="javascript:;">
                    <i class="fas fa-folder"></i>
                        <span>Bình luận</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/admin/binhluan/danhsach')}}"><i class="fas fa-clipboard-list"></i>Liệt kê</a></li>
                    </ul>
                </li>
                //@endhasrole
                //@hasrole(['Admin','NhanVienQuanLy'])
                <li class="sub-menu">
                    <a href="javascript:;">
                    <i class="fas fa-folder"></i>
                        <span>Quản lý người dùng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/admin/user/danhsach')}}"><i class="fas fa-clipboard-list"></i>Liệt kê</a></li>
                    </ul>
                </li>
                //@endhasrole
               // @hasrole(['NhanVienQuanLy','Admin'])
                <li class="sub-menu">
                    <a href="javascript:;">
                    <i class="fas fa-folder"></i>
                        <span>Quản lý khách hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('/admin/khachhang/danhsach')}}"><i class="fas fa-clipboard-list"></i>Danh sách</a></li>
                    </ul>
                </li>
                //@endhasrole
                <li>
                    <a href="LogoutAdmin">
                        <i class="fa fa-user"></i>
                        <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
