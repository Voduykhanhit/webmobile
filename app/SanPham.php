<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_name','category_id','brand_id','product_quantity','product_desc','product_content', 'product_price','product_image','product_status'
    ];


    public function danhmucsanpham(){
                return $this->beLongsTo('App\DanhMucSanPham','category_id','category_id');
    }
    public function thuonghieu(){
                return $this->beLongsTo('App\ThuongHieu','brand_id','brand_id');
    }
    public function hinhanh(){
        return $this->hasMany('App\HinhAnhSanPham','product_id','product_id');
    }
    public function chitiethoadon()
    {
        return $this->hasMany('App\ChiTietHoaDon','product_id','product_id');
    }
    
    public function comment(){
        return $this->hasMany('App\BinhLuan','product_id','product_id');
    }
}
