<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TraLoiBinhLuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_replycomment', function (Blueprint $table) {
            $table->increments('reply_id');
            $table->string('reply_content');
            $table->integer('comments_id')->unsigned();
            $table->integer('admin_id')->unsigned();
            $table->foreign('comments_id')->references('comments_id')->on('tbl_comments')->onDelete('cascade');
            $table->foreign('admin_id')->references('admin_id')->on('tbl_admin')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_replycomment');
    }
}
