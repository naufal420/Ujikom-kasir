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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->timestamp('tanggal_penjualan')->nullable();
            $table->decimal('total_harga');
            $table->unsignedBigInteger('id_member')->nullable();
            $table->string('diskon')->nullable();
            $table->decimal('jumlah_bayar');
            $table->decimal('kembalian');
            $table->foreign('id_member')->references('id_member')->on('member');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
};
