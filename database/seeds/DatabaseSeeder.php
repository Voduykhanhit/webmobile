<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Quyen;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
       // $this->call(QuyenSeeder::class);
        $this->call(XaSeeder::class);

    }
}

class QuanHuyenSeeder extends Seeder
{
    public function run()
    {
        DB::table("tbl_quanhuyen")->insert([
            ['name_quanhuyen'=>'Bình Tân','type'=>'Huyện','matp'=>3],
            ['name_quanhuyen'=>'Long Hồ','type'=>'Huyện','matp'=>3],
            ['name_quanhuyen'=>'Mang Thít','type'=>'Huyện','matp'=>3],
            ['name_quanhuyen'=>'Tam Bình','type'=>'Huyện','matp'=>3],
            ['name_quanhuyen'=>'Trà Ôn','type'=>'Huyện','matp'=>3],
            ['name_quanhuyen'=>'Dũng Liêm','type'=>'Huyện','matp'=>3],
            // ['name_quanhuyen'=>'Tân Hồng','type'=>'Huyện','matp'=>3],
            // ['name_quanhuyen'=>'Thanh Bình','type'=>'Huyện','matp'=>3],
            // ['name_quanhuyen'=>'Tháp Mười','type'=>'Huyện','matp'=>3],
        ]);
    }
}
class XaSeeder extends Seeder
{
    public function run()
    {
        DB::table("tbl_xaphuongthitran")->insert([
            ['name_xaphuong'=>'Bình Đức','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Bình Khánh','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Đông Xuyên','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Mỹ Bình','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Mỹ Hòa','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Mỹ Long','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Mỹ Phước','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Mỹ Qúy','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Mỹ Thạnh','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Mỹ Thới','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Mỹ Xuyên','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Mỹ Hòa Hưng','type'=>'Xã','maqh'=>10],
            ['name_xaphuong'=>'Mỹ Khánh','type'=>'Xã','maqh'=>10],
            //Vĩnh thạnh
            ['name_xaphuong'=>'Thạnh Qưới','type'=>'Xã','maqh'=>3],
            ['name_xaphuong'=>'Thạnh Mỹ','type'=>'Xã','maqh'=>3],
            ['name_xaphuong'=>'Thạnh An','type'=>'Xã','maqh'=>3],
            ['name_xaphuong'=>'Thạnh Thắng','type'=>'Xã','maqh'=>3],
            ['name_xaphuong'=>'Vĩnh Trinh','type'=>'Xã','maqh'=>3],
            ['name_xaphuong'=>'Thạnh Phú','type'=>'Xã','maqh'=>3],
            ['name_xaphuong'=>'Trung Hưng','type'=>'Xã','maqh'=>3],
            ['name_xaphuong'=>'Thạnh Lộc','type'=>'Xã','maqh'=>3],
            ['name_xaphuong'=>'Thị Trấn Thạnh An','type'=>'Xã','maqh'=>3],
            ['name_xaphuong'=>'Thị Trấn Vĩnh Thạnh','type'=>'Xã','maqh'=>3],
            //Cờ Đỏ
            ['name_xaphuong'=>'Đông Hiệp','type'=>'Xã','maqh'=>2],
            ['name_xaphuong'=>'Đông Thắng','type'=>'Xã','maqh'=>2],
            ['name_xaphuong'=>'Thạnh Phú','type'=>'Xã','maqh'=>2],
            ['name_xaphuong'=>'Thới Đông','type'=>'Xã','maqh'=>2],
            ['name_xaphuong'=>'Thới Hưng','type'=>'Xã','maqh'=>2],
            ['name_xaphuong'=>'Thới Xuân','type'=>'Xã','maqh'=>2],
            ['name_xaphuong'=>'Trung An','type'=>'Xã','maqh'=>2],
            ['name_xaphuong'=>'Trung Hưng','type'=>'Xã','maqh'=>2],
            ['name_xaphuong'=>'Trung Thạnh','type'=>'Xã','maqh'=>2],
            ['name_xaphuong'=>'Thị Trấn Cờ Đỏ','type'=>'Thị Trấn','maqh'=>2],
            //Phong Điền
            ['name_xaphuong'=>'Giai Xuân','type'=>'Xã','maqh'=>1],
            ['name_xaphuong'=>'Mỹ Khánh','type'=>'Xã','maqh'=>1],
            ['name_xaphuong'=>'Nhơn Ái','type'=>'Xã','maqh'=>1],
            ['name_xaphuong'=>'Nhơn Nghĩa','type'=>'Xã','maqh'=>1],
            ['name_xaphuong'=>'Tân Thới','type'=>'Xã','maqh'=>1],
            ['name_xaphuong'=>'Trường Long','type'=>'Xã','maqh'=>1],
            ['name_xaphuong'=>'Thị Trấn Phong Điền','type'=>'Thị Trấn','maqh'=>1],
            //Thôt nốt
            ['name_xaphuong'=>'Thới Thuận','type'=>'Xã','maqh'=>4],
            ['name_xaphuong'=>'Trung Nhứt','type'=>'Xã','maqh'=>4],
            ['name_xaphuong'=>'Trung Kiên','type'=>'Xã','maqh'=>4],
            ['name_xaphuong'=>'Thuận Hưng','type'=>'Xã','maqh'=>4],
            ['name_xaphuong'=>'Tân Hưng','type'=>'Xã','maqh'=>4],
            ['name_xaphuong'=>'Tân Lộc','type'=>'Xã','maqh'=>4],
            ['name_xaphuong'=>'TT Thốt Nốt','type'=>'Thị Trấn','maqh'=>4],
            //Ninh Kiều
            ['name_xaphuong'=>'Cái Khế','type'=>'Xã','maqh'=>5],
            ['name_xaphuong'=>'An Hòa','type'=>'Xã','maqh'=>5],
            ['name_xaphuong'=>'Thới Bình','type'=>'Xã','maqh'=>5],
            ['name_xaphuong'=>'An Nghiệp','type'=>'Xã','maqh'=>5],
            ['name_xaphuong'=>'An Cư','type'=>'Xã','maqh'=>5],
            ['name_xaphuong'=>'An Hội','type'=>'Xã','maqh'=>5],
            ['name_xaphuong'=>'Tân An','type'=>'Xã','maqh'=>5],
            ['name_xaphuong'=>'An Lạc','type'=>'Xã','maqh'=>5],
            ['name_xaphuong'=>'An Phú','type'=>'Xã','maqh'=>5],
            ['name_xaphuong'=>'Xuân Khánh','type'=>'Xã','maqh'=>5],
            ['name_xaphuong'=>'Hưng Lợi','type'=>'Xã','maqh'=>5],
            ['name_xaphuong'=>'An Bình','type'=>'Xã','maqh'=>5],
            //Bình Thủy
            ['name_xaphuong'=>'An Thới','type'=>'Xã','maqh'=>6],
            ['name_xaphuong'=>'Bình Thủy','type'=>'Xã','maqh'=>6],
            ['name_xaphuong'=>'Bùi Hữu Nghĩa','type'=>'Xã','maqh'=>6],
            ['name_xaphuong'=>'Long Hòa','type'=>'Xã','maqh'=>6],
            ['name_xaphuong'=>'Long Tuyền','type'=>'Xã','maqh'=>6],
            ['name_xaphuong'=>'Thới An Đông','type'=>'Xã','maqh'=>6],
            ['name_xaphuong'=>'Trà An','type'=>'Xã','maqh'=>6],
            ['name_xaphuong'=>'Trà Nốc','type'=>'Xã','maqh'=>6],
            //Cái Răng
            ['name_xaphuong'=>'Lê Bình','type'=>'Xã','maqh'=>7],
            ['name_xaphuong'=>'Thường Thạnh','type'=>'Xã','maqh'=>7],
            ['name_xaphuong'=>'Phú Thứ','type'=>'Xã','maqh'=>7],
            ['name_xaphuong'=>'Tân Phú','type'=>'Xã','maqh'=>7],
            ['name_xaphuong'=>'Ba Láng','type'=>'Xã','maqh'=>7],
            ['name_xaphuong'=>'Hưng Phú','type'=>'Xã','maqh'=>7],
            ['name_xaphuong'=>'Hưng Thạnh','type'=>'Xã','maqh'=>7],
            //Ô môn
            ['name_xaphuong'=>'Định Môn','type'=>'Xã','maqh'=>8],
            ['name_xaphuong'=>'Đông Thuận','type'=>'Xã','maqh'=>8],
            ['name_xaphuong'=>'Phước Thới','type'=>'Xã','maqh'=>8],
            ['name_xaphuong'=>'Tân Thới','type'=>'Xã','maqh'=>8],
            ['name_xaphuong'=>'Thới An','type'=>'Xã','maqh'=>8],
            ['name_xaphuong'=>'Thới Đông','type'=>'Xã','maqh'=>8],
            ['name_xaphuong'=>'Thới Lai','type'=>'Xã','maqh'=>8],
            ['name_xaphuong'=>'Thới Long','type'=>'Xã','maqh'=>8],
            ['name_xaphuong'=>'Thới Thạnh','type'=>'Xã','maqh'=>8],
            ['name_xaphuong'=>'Trường Lạc','type'=>'Xã','maqh'=>8],
            ['name_xaphuong'=>'Trường Thành','type'=>'Xã','maqh'=>8],
            ['name_xaphuong'=>'Trường Xuân','type'=>'Xã','maqh'=>8],
            //Châu Đốc
            ['name_xaphuong'=>'Châu Phú A','type'=>'Xã','maqh'=>9],
            ['name_xaphuong'=>'Châu Phú B','type'=>'Xã','maqh'=>9],
            ['name_xaphuong'=>'Núi Sam','type'=>'Xã','maqh'=>9],
            ['name_xaphuong'=>'Vĩnh Mỹ','type'=>'Xã','maqh'=>9],
            ['name_xaphuong'=>'Vĩnh Ngơn','type'=>'Xã','maqh'=>9],
            ['name_xaphuong'=>'Vĩnh Tới','type'=>'Xã','maqh'=>9],
            ['name_xaphuong'=>'Vĩnh Châu','type'=>'Xã','maqh'=>9],
            //Tân Châu
            ['name_xaphuong'=>'Long Thạnh','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Long Hưng','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Long Châu','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Long Sơn','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Long Phú','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Phú Lộc','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Vĩnh Xương','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Vĩnh Hòa','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Tân Thạnh','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Tân An','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Long An','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Châu Phong','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Phú Vĩnh','type'=>'Xã','maqh'=>11],
            ['name_xaphuong'=>'Lê Chánh','type'=>'Xã','maqh'=>11],
            //An Phú
            ['name_xaphuong'=>'Đa Phước','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Khánh An','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Khánh Bình','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Nhơn Hội','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Phú Hội','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Phú Hữu','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Phước Hưng','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Quốc Thái','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Vĩnh Hậu','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Vĩnh Hội Đông','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Vĩnh Lộc','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Vĩnh Trường','type'=>'Xã','maqh'=>12],
            ['name_xaphuong'=>'Thị Trấn An Phú','type'=>'Thị Trấn','maqh'=>12],
            ['name_xaphuong'=>'Thị Trấn Long Bình','type'=>'Thị Trấn','maqh'=>12],
            //Châu Phú
            ['name_xaphuong'=>'Cái Dầu','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Vĩnh Thạnh Trung','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Bình Chánh','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Bình Long','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Bình Mỹ','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Bình Phú','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Bình Thủy','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Đào Hữu Cảnh','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Khánh Hòa','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Mỹ Đức','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Mỹ Phú','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Ô Long Vỹ','type'=>'Xã','maqh'=>13],
            ['name_xaphuong'=>'Thạnh Mỹ Tây','type'=>'Xã','maqh'=>13],
            //Châu Thành
            ['name_xaphuong'=>'An Hòa','type'=>'Xã','maqh'=>14],
            ['name_xaphuong'=>'Bình Hòa','type'=>'Xã','maqh'=>14],
            ['name_xaphuong'=>'Bình Thạnh','type'=>'Xã','maqh'=>14],
            ['name_xaphuong'=>'Cần Đăng','type'=>'Xã','maqh'=>14],
            ['name_xaphuong'=>'Hòa Bình Thạnh','type'=>'Xã','maqh'=>14],
            ['name_xaphuong'=>'Tân Phú','type'=>'Xã','maqh'=>14],
            ['name_xaphuong'=>'Vĩnh An','type'=>'Xã','maqh'=>14],
            ['name_xaphuong'=>'Vĩnh Hanh','type'=>'Xã','maqh'=>14],
            ['name_xaphuong'=>'Vĩnh Lợi','type'=>'Xã','maqh'=>14],
            ['name_xaphuong'=>'Vĩnh Nhuận','type'=>'Xã','maqh'=>14],
            ['name_xaphuong'=>'Vĩnh Thành','type'=>'Xã','maqh'=>14],
            ['name_xaphuong'=>'Thị Trấn An Châu','type'=>'Thị Trấn','maqh'=>14],
            ['name_xaphuong'=>'Thị Trấn Vĩnh Bình','type'=>'Thị Trấn','maqh'=>14],
            //Chợ Mới
            ['name_xaphuong'=>'An Thạnh Trung','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Bình Phước Xuân','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Hòa An','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Hòa Bình','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Hội An','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Kiến An','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Kiến Thành','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Long Điền A','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Long Điền','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Long Giang','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Long Kiến','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Mỹ An','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Mỹ Hiệp','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Mỹ Hội Đông','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Nhơn Mỹ','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'Tấn Mỹ','type'=>'Xã','maqh'=>15],
            ['name_xaphuong'=>'TT Chợ Mới','type'=>'Thị Trấn','maqh'=>15],
            ['name_xaphuong'=>'TT Mỹ Luông','type'=>'Thị Trấn','maqh'=>15],
            //Phú Tân
            ['name_xaphuong'=>'Bình Thạnh Đông','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Hiệp Xương','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Hòa Lạc','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Long Hòa','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Phú An','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Phú Bình','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Phú Hiệp','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Phú Hưng','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Phú Lâm','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Phú Long','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Phú Thành','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Phú Thạnh','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Phú Thọ','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Phú Xuân','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Tân Hòa','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'Tân Trung','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'TT Phú Mỹ','type'=>'Xã','maqh'=>17],
            ['name_xaphuong'=>'TT Chợ Vàm','type'=>'Xã','maqh'=>17],
            //Tịnh Biên
            ['name_xaphuong'=>'An Cư','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'An Hảo','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'An Nông','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'An Phú','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'Nhơn Hưng','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'Núi Voi','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'Tân Lộc','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'Tân Lợi','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'Thới Sơn','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'Văn Giáo','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'Vĩnh Trung','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'TT Tịnh Biên','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'TT Chi Lăng','type'=>'Xã','maqh'=>18],
            ['name_xaphuong'=>'TT Nhà Bàng','type'=>'Xã','maqh'=>18],
            //Tri Tôn
            ['name_xaphuong'=>'An Tức','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'Châu Lăng','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'Lạc Qưới','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'Lê Trì','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'Lương An Trà','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'Lương Phi','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'Núi Tô','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'Ô Lâm','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'Tà Đãnh','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'Tân Tuyến','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'Vĩnh Gia','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'Vĩnh Phước','type'=>'Xã','maqh'=>19],
            ['name_xaphuong'=>'TT Tri Tôn','type'=>'Thị Trấn','maqh'=>19],
            ['name_xaphuong'=>'TT Ba Chúc','type'=>'Thị Trấn','maqh'=>19],
            ['name_xaphuong'=>'TT Cô Tô','type'=>'Thị Trấn','maqh'=>19],
            //Thị xã bình minh
            ['name_xaphuong'=>'Cái Vồn','type'=>'Xã','maqh'=>20],
            ['name_xaphuong'=>'Đông Thuận','type'=>'Xã','maqh'=>20],
            ['name_xaphuong'=>'Thành Phước','type'=>'Xã','maqh'=>20],
            ['name_xaphuong'=>'Đông Bình','type'=>'Xã','maqh'=>20],
            ['name_xaphuong'=>'Đông Thành','type'=>'Xã','maqh'=>20],
            ['name_xaphuong'=>'Đông Thạnh','type'=>'Xã','maqh'=>20],
            ['name_xaphuong'=>'Mỹ Hòa','type'=>'Xã','maqh'=>20],
            ['name_xaphuong'=>'Thuận An','type'=>'Xã','maqh'=>20],




           
            



        ]);
    }
}
class QuyenSeeder extends Seeder
{
    public function run()
    {
        DB::table("tbl_roles")->insert([
            //['roles_name'=>'Admin'],
            //['roles_name'=>'Editor'],
            //['roles_name'=>'Censorship']
            ['roles_name'=>'User']

        ]);

        
    }
}

