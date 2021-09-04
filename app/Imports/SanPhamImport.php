<?php

namespace App\Imports;

use App\SanPham;
use App\ThuongHieu;
use App\DanhMucSanPham;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SanPhamImport implements ToModel,WithHeadingRow
{
    /* 
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SanPham([
            'product_name' => $row['ten_san_pham'],
            'category_id' => $row['danh_muc'],
            'brand_id' => $row['thuong_hieu'],
            'product_quantity' => $row['so_luong'],
            'product_desc' => $row['mo_ta'],
            'product_content' => $row['noi_dung'],
            'product_price' => $row['gia_san_pham'],
            'product_image' => $row['hinh_anh'],
            'product_status' => $row['trang_thai'],
        ]);
      
    }
    public function headingRow(): int     
    {         
        return 6;
    }
    // public function map($row): array 
    // { 
    //     return [ $row->product_name, $row->danhmucsanpham->category_name, $row->thuonghieu->brand_name, $row->product_quantity, $row->product_desc, $row->product_content,$row->product_price,$row->product_image,$row->product_status, ]; 
    // } 
}
