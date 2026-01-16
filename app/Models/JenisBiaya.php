<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisbiaya extends Model
{
    use HasFactory;

    protected $table = 'jenisbiaya';

    protected $fillable = [
        'id',
        'nama',
        'jumlah_biaya'
    ];
}
