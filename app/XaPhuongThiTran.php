<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XaPhuongThiTran extends Model
{
    protected $table = 'tbl_xaphuongthitran';
    protected $primaryKey = 'xaid';

   public function quanhuyen(){
       return $this->beLongsTo('App\QuanHuyen','maqh','maqh');
   }
   public function phivanchuyen()
   {
       return $this->hasMany('App\PhiVanChuyen','xaid','xaid');
   }
}
