<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiKeluar extends Model
{
    protected $table = 'transaksi_keluars';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_sparepart',
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

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }
}