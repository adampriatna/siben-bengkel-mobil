<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $primaryKey = 'id_supplier';

    protected $fillable = [
        'nama_supplier',
        'kontak',
        'alamat',
    ];

    public function transaksiMasuk()
    {
        return $this->hasMany(
            TransaksiMasuk::class,
            'id_supplier',
            'id_supplier'
        );
    }
}