<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraLoiBinhLuan extends Model
{
  protected $table = 'tbl_replycomment';
   protected $primaryKey = 'reply_id';

   public function binhluan()
   {
       return $this->beLongsTo('App\BinhLuan','comments_id','comments_id');
   }
   public function admin()
   {
       return $this->beLongsTo('App\Admin','admin_id','admin_id');
   }
}
