<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'no_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];
    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'no_transaksi', 'no_transaksi');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'no_reg', 'no_reg');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas', 'username');
    }
}