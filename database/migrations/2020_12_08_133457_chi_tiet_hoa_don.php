<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChiTietHoaDon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order_details', function (Blueprint $table) {
            $table->Increments('order_details_id');
            $table->Integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->String('product_name');
            $table->String('product_price');
            $table->integer('product_sales_quantity');
            $table->string('product_coupon')->nullable();
            $table->string('product_feeship')->nullable();
           $table->String('order_code');
            $table->foreign('product_id')->references('product_id')->on('tbl_product')->onDelete('cascade');
    
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
        Schema::dropIfExists('tbl_order_details');
    }
}
