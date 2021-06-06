<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CartDetailCreateCartDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cart_id')->unsigned()->comment('Cột id trong bảng cart, khóa ngoại');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->integer('quantity')->comment('Số lượng');
            $table->bigInteger('product_id')->unsigned()->comment('Cột id trong bảng ec_products, khóa ngoại');
            $table->foreign('product_id')->references('id')->on('ec_products')->onDelete('cascade');
            $table->string('status', 60)->default('published');
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
        Schema::dropIfExists('cart_details');
    }
}
