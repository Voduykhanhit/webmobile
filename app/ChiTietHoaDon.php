<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    protected $table = 'tbl_order_details';
    protected $primaryKey = 'order_details_id';
    protected $fillable = [
        'product_id', 'product_name', 'product_price','product_sales_quantity','product_coupon','product_feeship','order_code','create_at','updated_at'
    ];
    
    public function sanpham()
    {
        return $this->beLongsTo('App\SanPham','product_id','product_id');
    }
   
}
