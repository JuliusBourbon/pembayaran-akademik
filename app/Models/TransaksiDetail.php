<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id_detail';
    public $incrementing = true; 
    protected $keyType = 'int';
    public $timestamps = false;
    protected $guarded = [];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'no_transaksi', 'no_transaksi');
    }

    public function jenisBiaya()
    {
        return $this->belongsTo(JenisBiaya::class, 'id_jenis_biaya', 'id_jenis_biaya');
    }
}