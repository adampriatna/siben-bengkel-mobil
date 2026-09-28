<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $table = 'spareparts';

    protected $primaryKey = 'id_sparepart';

    protected $fillable = [
        'kode_sparepart',
        'nama_sparepart',
        'id_kategori',
        'harga',
        'stok',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function transaksiMasuk()
    {
        return $this->hasMany(TransaksiMasuk::class, 'id_sparepart', 'id_sparepart');
    }

    public function transaksiKeluar()
    {
        return $this->hasMany(TransaksiKeluar::class, 'id_sparepart', 'id_sparepart');
    }
}