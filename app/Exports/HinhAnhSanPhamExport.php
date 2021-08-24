<?php

namespace App\Exports;

use App\HinhAnhSanPham;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
 use Maatwebsite\Excel\Concerns\WithCustomStartCell;
  use Maatwebsite\Excel\Concerns\WithMapping;

class HinhAnhSanPhamExport implements FromCollection,WithHeadings,WithCustomStartCell,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array 
    { 
        return ['Hình ảnh', 'Sản phẩm',]; 
    } 
    public function map($row): array 
    { 
        return [$row->image,$row->product_id]; 
    } 
    public function startCell(): string 
    { 
        return 'A6'; 
    }
    public function collection()
    {
        return HinhAnhSanPham::all();
    }
}
