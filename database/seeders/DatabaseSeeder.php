<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $kategori1 = \App\Models\Kategori::create([
        'nama_kategori' => 'Mesin',
    ]);

    $kategori2 = \App\Models\Kategori::create([
        'nama_kategori' => 'Rem',
    ]);

    $supplier = \App\Models\Supplier::create([
        'nama_supplier' => 'PT Sumber Sparepart',
        'kontak' => '081234567890',
        'alamat' => 'Jombang',
    ]);

    $user = \App\Models\User::create([
        'nama' => 'Admin Bengkel',
        'username' => 'admin',
        'password' => bcrypt('123456'),
        'role' => 'Admin',
    ]);

    $sparepart1 = \App\Models\Sparepart::create([
        'kode_sparepart' => 'SP001',
        'nama_sparepart' => 'Kampas Rem',
        'id_kategori' => $kategori2->id_kategori,
        'harga' => 150000,
        'stok' => 20,
    ]);

    $sparepart2 = \App\Models\Sparepart::create([
        'kode_sparepart' => 'SP002',
        'nama_sparepart' => 'Oli Mesin',
        'id_kategori' => $kategori1->id_kategori,
        'harga' => 75000,
        'stok' => 30,
    ]);

    \App\Models\TransaksiMasuk::create([
        'id_sparepart' => $sparepart1->id_sparepart,
        'id_supplier' => $supplier->id_supplier,
        'id_user' => $user->id_user,
        'jumlah' => 10,
        'tanggal' => now(),
        'keterangan' => 'Stok masuk',
    ]);

    \App\Models\TransaksiKeluar::create([
        'id_sparepart' => $sparepart1->id_sparepart,
        'id_user' => $user->id_user,
        'jumlah' => 2,
        'tanggal' => now(),
        'keterangan' => 'Stok keluar',
    ]);
}
}
