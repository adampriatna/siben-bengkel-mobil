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
    Schema::create('spareparts', function (Blueprint $table) {
        $table->id('id_sparepart');
        $table->string('kode_sparepart')->unique();
        $table->string('nama_sparepart');
        $table->unsignedBigInteger('id_kategori');
        $table->decimal('harga', 12, 2);
        $table->integer('stok')->default(0);
        $table->timestamps();

        $table->foreign('id_kategori')
              ->references('id_kategori')
              ->on('kategoris')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spareparts');
    }
};
