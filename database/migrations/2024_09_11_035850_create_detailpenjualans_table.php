<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailpenjualan', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_penjualan');
            $table->unsignedBigInteger('id_product');
            $table->integer('jumlah_product');
            $table->decimal('sub_total');
            $table->foreign('id_penjualan')->references('id_penjualan')->on('penjualan');
            $table->foreign('id_product')->references('id_product')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailpenjualan');
    }
};
