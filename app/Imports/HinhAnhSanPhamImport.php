<?php

namespace App\Imports;

use App\HinhAnhSanPham;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HinhAnhSanPhamImport implements ToModel,WithHeadingRow
{
    /*
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HinhAnhSanPham([
            'image' =>$row['hinh_anh'],
            'product_id'=>$row['san_pham'],
        ]);
    }
    public function headingRow(): int     
    {         
        return 6;     
    }
}
