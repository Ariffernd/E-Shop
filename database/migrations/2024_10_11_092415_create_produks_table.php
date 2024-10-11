<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('foto');
            $table->string('thumb');
            $table->foreignId('kategori_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sub_kategori_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_produk');
            $table->text('deskripsi');
            $table->integer('berat_barang');
            $table->string('satuan');
            $table->integer('stok')->default(0);
            $table->decimal('harga',10,2);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
