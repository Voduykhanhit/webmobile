<?php

namespace App\Exports;

use App\SanPham;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
 use Maatwebsite\Excel\Concerns\WithCustomStartCell;
  use Maatwebsite\Excel\Concerns\WithMapping;

class SanPhamExport implements FromCollection,WithHeadings,WithCustomStartCell,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array 
    { 
        return [ 'Tên sản phẩm', 'Danh mục', 'Thương hiệu', 'Số lượng', 'Mô tả','Nội dung','Giá sản phẩm', 'Hình ảnh','Trạng thái',]; 
    } 
    public function map($row): array 
    { 
        return [ $row->product_name, $row->category_id, $row->brand_id, $row->product_quantity, $row->product_desc, $row->product_content,$row->product_price,$row->product_image,$row->product_status, ]; 
    } 
    public function startCell(): string 
    { 
        return 'A6'; 
    }
    public function collection()
    {
        return SanPham::all();
    }
}
