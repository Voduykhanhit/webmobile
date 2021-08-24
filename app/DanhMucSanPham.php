<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DanhMucSanPham extends Model
{
    protected $table = 'tbl_category_product';
    protected $primaryKey = 'category_id';
    public function sanpham(){
            return $this->hasMany('App\SanPham','category_id','category_id');
    }
    
}
