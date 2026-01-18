<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBiaya extends Model
{
    protected $table = 'jenis_biaya';
    protected $primaryKey = 'id_jenis_biaya';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    public function transaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_jenis_biaya', 'id_jenis_biaya');
    }
}