<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaoHang extends Model
{
   protected $table = 'tbl_shipping';
   protected $primaryKey = 'shipping_id';

   public function hoadon()
   {
      return $this->hasMany('App\HoaDon','shipping_id','shipping_id');
   }
}
