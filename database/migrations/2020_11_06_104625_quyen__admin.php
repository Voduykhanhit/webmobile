<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuyenAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->increments('id_admin_roles');
            $table->integer('admin_admin_id')->unsigned();
            $table->integer('roles_roles_id')->unsigned();
            $table->foreign('admin_admin_id')->references('admin_id')->on('tbl_admin')->onDelete('cascade');
            $table->foreign('roles_roles_id')->references('roles_id')->on('tbl_roles')->onDelete('cascade');
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
        Schema::dropIfExists('admin_roles');
    }
}
