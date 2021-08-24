<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PhiVanChuyen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_feeship', function (Blueprint $table) {
            $table->increments('fee_id');
            $table->integer('matp')->unsigned();
            $table->integer('maqh')->unsigned();
            $table->integer('xaid')->unsigned();
            $table->string('fee_feeship');
            $table->foreign('matp')->references('matp')->on('tbl_tinhthanhpho')->onDelete('cascade');
            $table->foreign('maqh')->references('maqh')->on('tbl_quanhuyen')->onDelete('cascade');
            $table->foreign('xaid')->references('xaid')->on('tbl_xaphuongthitran')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_feeship');
    }
}
