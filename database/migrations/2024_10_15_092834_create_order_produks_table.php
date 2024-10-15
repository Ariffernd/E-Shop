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
        Schema::create('order_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained()->onDelete('cascade');
            $table->string('order_id');
            $table->string('snap_id');
            $table->string('nama');
            $table->text('alamat');
            $table->string('nomor_wa');
            $table->string('email');
            $table->integer('harga');
            $table->integer('qty');
            $table->string('ongkir');
            $table->integer('total_bayar');
            $table->string('no_resi')->nullable();
            $table->string('status_pemesanan');
            $table->string('metode_pembayaran');
            $table->string('status_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_produks');
    }
};
