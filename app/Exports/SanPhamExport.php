<?php

namespace App\Exports;

use App\SanPham;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;

class SanPhamExport implements FromCollection,WithHeadings,WithCustomStartCell,WithMapping,WithDrawings,WithEvents
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
    // Chỉnh thiết kế
    public function registerEvents(): array
    {
        // Setting bộ thiết kế
        Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
            $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
        });
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        return [
            
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    
                $event->sheet->styleCells(
                    'A6:I6',
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['rba' => '240, 188, 46'],
                            ],
                        
                        ],
                        'font'=>[
                            'bold'=>true
                        ]
                    ]
                );
            },
        ];
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('./1200px-Laravel.svg.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
}
