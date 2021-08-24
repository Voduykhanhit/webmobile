<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThanhToan extends Model
{
    protected $table = 'tbl_payment';
    protected $primaryKey = 'payment_id';

    public function hoadon()
    {
        return $this->hasMany('App\HoaDon','payment_id','payment_id');
    }
}
