<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = 'tbl_customers';
    protected $primaryKey = 'customer_id';

    public function hoadon()
    {
        return $this->hasMany('App\HoaDon','customer_id','customer_id');
    }
    public function khcomment()
    {
        return $this->hasMany('App\KhachHangBinhLuan','customer_id','customer_id');
    }
}
