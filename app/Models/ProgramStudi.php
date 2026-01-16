<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programstudi extends Model
{
    use HasFactory;

    protected $table = 'programstudi';

    protected $fillable = [
        'id_prodi',
        'nama_prodi',
    ];
}
