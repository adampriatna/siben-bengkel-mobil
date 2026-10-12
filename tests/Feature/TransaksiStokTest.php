<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Sparepart;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransaksiStokTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_stock_in_transaction_and_increase_stock(): void
    {
        $kategori = Kategori::create(['nama_kategori' => 'Oli']);
        $supplier = Supplier::create([
            'nama_supplier' => 'PT Sumber Parts',
            'kontak' => '08123456789',
            'alamat' => 'Jl. Merdeka 1',
        ]);
        $sparepart = Sparepart::create([
            'kode_sparepart' => 'SP-001',
            'nama_sparepart' => 'Oli Mesin 10W-40',
            'id_kategori' => $kategori->id_kategori,
            'harga' => 150000,
            'stok' => 10,
        ]);

        $response = $this->post('/transaksi-masuk', [
            'id_sparepart' => $sparepart->id_sparepart,
            'id_supplier' => $supplier->id_supplier,
            'jumlah' => 5,
            'tanggal' => '2026-10-12',
            'keterangan' => 'Pembelian stok awal',
        ]);

        $response->assertRedirect('/transaksi-masuk');
        $this->assertDatabaseHas('transaksi_masuks', [
            'id_sparepart' => $sparepart->id_sparepart,
            'id_supplier' => $supplier->id_supplier,
            'jumlah' => 5,
        ]);
        $this->assertEquals(15, $sparepart->fresh()->stok);
    }

    public function test_cannot_create_stock_out_transaction_when_stock_is_insufficient(): void
    {
        $kategori = Kategori::create(['nama_kategori' => 'Ban']);
        $sparepart = Sparepart::create([
            'kode_sparepart' => 'SP-002',
            'nama_sparepart' => 'Ban Mobil 175/65R14',
            'id_kategori' => $kategori->id_kategori,
            'harga' => 400000,
            'stok' => 2,
        ]);

        $response = $this->from('/transaksi-keluar')->post('/transaksi-keluar', [
            'id_sparepart' => $sparepart->id_sparepart,
            'jumlah' => 5,
            'tanggal' => '2026-10-12',
            'keterangan' => 'Penjualan motor',
        ]);

        $response->assertRedirect('/transaksi-keluar');
        $response->assertSessionHasErrors(['jumlah']);
        $this->assertEquals(2, $sparepart->fresh()->stok);
    }
}
