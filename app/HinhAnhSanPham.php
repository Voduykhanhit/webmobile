<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HinhAnhSanPham extends Model
{
    protected $table = 'tbl_product_image';
    protected $primaryKey = 'image_id';
    protected $fillable = [
        'image','product_id'
    ];
    
    public function sanpham(){
        return $this->beLongsTo('App\SanPham','product_id','product_id');
    }


}
