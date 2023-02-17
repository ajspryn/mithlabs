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
        Schema::create('transaksi_bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_order');
            $table->string('sku_bahan_baku');
            $table->string('jenis_transaksi');
            $table->string('jumlah');
            $table->text('catatan');
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
        Schema::dropIfExists('transaksi_bahan_bakus');
    }
};
