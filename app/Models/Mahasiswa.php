<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'alamat',
        'telepon',
        'telepon_ortu',
        'user',
        'password',
        'email',
        'virtual_account',
        'id_prodi',
        'id_fakultas',
    ];
}
