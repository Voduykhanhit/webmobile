<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    protected $table = 'tbl_roles';
    protected $primaryKey = 'roles_id';
    protected $fillable = [
    	'roles_name'
    ];
    public function admin()
    {
        return $this->belongsToMany('App\Admin','admin_roles','roles_roles_id','admin_admin_id');
    }

}
