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
        Schema::create('order_bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('sku_bahan_baku');
            $table->string('kode_produksi')->nullable();
            $table->string('jumlah');
            $table->string('status');
            $table->string('kode_vendor')->nullable();
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('order_bahan_bakus');
    }
};
