<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    protected $table = 'tbl_admin';
    protected $primaryKey = 'admin_id';

    public function getAuthPassword(){
        return $this->admin_password;
    }
    public function roles()
    {
        return $this->belongsToMany('App\Quyen','admin_roles','admin_admin_id','roles_roles_id');
    }
    public function replycomment()
    {
        return $this->hasMany('App\TraLoiBinhLuan','admin_id','admin_id');
    }
    public function hasAnyRoles($roles)
    {
        
        return null !== $this->roles()->whereIn('roles_name',$roles)->first();
    }
    
    public function hasRole($role)
    {
        return null !== $this->roles()->where('roles_name',$role)->first(); //trả về giá trị rỗng khi biến muốn đem so sánh khác biến trong cơ sở dữ liệu
    }
}
