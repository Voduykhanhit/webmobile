<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuanHuyen extends Model
{
    protected $table = 'tbl_quanhuyen';
    protected $primaryKey = 'maqh';

    public function tinhthanhpho(){
        return $this->beLongsTo('App\TinhThanhPho','matp','matp');
    }
    public function xaphuongthitran(){
        return $this->hasMany('App\XaPhuongThiTran','maqh','maqh');
    }
    public function phivanchuyen()
    {
        return $this->hasMany('App\PhiVanChuyen','maqh','maqh');
    }
}
