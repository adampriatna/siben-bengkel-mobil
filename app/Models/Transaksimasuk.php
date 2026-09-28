<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiMasuk extends Model
{
    protected $table = 'transaksi_masuks';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_sparepart',
        'id_supplier',
        'id_user',
        'jumlah',
        'tanggal',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function sparepart()
    {
        return $this->belongsTo(
            Sparepart::class,
            'id_sparepart',
            'id_sparepart'
        );
    }

    public function supplier()
    {
        return $this->belongsTo(
            Supplier::class,
            'id_supplier',
            'id_supplier'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }
}