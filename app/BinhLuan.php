<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    protected $table = "tbl_comments";
    protected $primaryKey = "comments_id";

    public function sanpham()
    {
        return $this->beLongsTo('App\SanPham','product_id','product_id');
    }
    public function reply(){
        return $this->hasMany('App\TraLoiBinhLuan','comments_id','comments_id');
    }
}
