<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinhThanhPho extends Model
{
    protected $table = 'tbl_tinhthanhpho';
    protected $primaryKey = 'matp';

    public function xaphuongthitran(){
        return $this->hasManyThrough('App\XaPhuongThiTran','App\QuanHuyen','matp','maqh','matp');
    }
    public function quanhuyen()
    {
        return $this->hasMany('App\QuanHuyen','matp','matp');
    }
    public function phivanchuyen()
    {
        return $this->hasMany('App\PhiVanChuyen','matp','matp');
    }
}
