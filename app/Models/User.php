<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function transaksiMasuk()
    {
        return $this->hasMany(
            TransaksiMasuk::class,
            'id_user',
            'id_user'
        );
    }

    public function transaksiKeluar()
    {
        return $this->hasMany(
            TransaksiKeluar::class,
            'id_user',
            'id_user'
        );
    }
}