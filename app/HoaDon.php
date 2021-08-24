<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';

    public function giaohang(){
        return $this->beLongsTo('App\GiaoHang','shipping_id','shipping_id');
    }
    public function khachhang()
    {
        return $this->beLongsTo('App\KhachHang','customer_id','customer_id');
    }
    public function thanhtoan()
    {
        return $this->beLongsTo('App\ThanhToan','payment_id','payment_id');
    }
    
    
}
