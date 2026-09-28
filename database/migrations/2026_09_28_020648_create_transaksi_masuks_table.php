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
    Schema::create('transaksi_masuks', function (Blueprint $table) {
        $table->id('id_transaksi');
        $table->unsignedBigInteger('id_sparepart');
        $table->unsignedBigInteger('id_supplier');
        $table->unsignedBigInteger('id_user');
        $table->integer('jumlah');
        $table->date('tanggal');
        $table->text('keterangan')->nullable();
        $table->timestamps();

        $table->foreign('id_sparepart')
              ->references('id_sparepart')
              ->on('spareparts')
              ->onDelete('cascade');

        $table->foreign('id_supplier')
              ->references('id_supplier')
              ->on('suppliers')
              ->onDelete('cascade');

        $table->foreign('id_user')
              ->references('id_user')
              ->on('users')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_masuks');
    }
};
