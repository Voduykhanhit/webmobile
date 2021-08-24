<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhiVanChuyen extends Model
{
    
    protected $table = 'tbl_feeship';
    protected $primaryKey = 'fee_id';

    public function tinhthanhpho()
    {
        return $this->beLongsTo('App\TinhThanhPho','matp','matp');
    }
    public function quanhuyen()
    {
        return $this->beLongsTo('App\QuanHuyen','maqh','maqh');
    }
    public function xaphuongthitran()
    {
        return $this->beLongsTo('App\XaPhuongThiTran','xaid','xaid');
    }
}
