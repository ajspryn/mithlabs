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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('sku')->unique();
            $table->string('foto_product')->nullable();
            $table->string('desain_product')->nullable();
            $table->text('nama');
            $table->text('nama_singkat');
            $table->string('kode_brand');
            $table->string('warna');
            $table->text('kategori');
            $table->text('sku_config')->nullable();
            $table->string('active_at');
            $table->string('cogm')->nullable();
            $table->string('cogs')->nullable();
            $table->string('harga_marketplace');
            $table->string('harga_jual');
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
        Schema::dropIfExists('products');
    }
};
