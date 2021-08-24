<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    protected $table = 'tbl_brand';
    protected $primaryKey = 'brand_id';
    
    public function sanpham(){
        return $this->hasMany("App/SanPham",'brand_id','brand_id');

    }
}
