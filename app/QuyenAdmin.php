<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuyenAdmin extends Model
{
    protected $fillable = [
    	'admin_admin_id','roles_roles_id','created_at','updated_at'
    ];
    protected $primaryKey = 'id_admin_roles';
 	protected $table = 'admin_roles';
}
