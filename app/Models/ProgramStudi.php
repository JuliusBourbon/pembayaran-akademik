<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programstudi extends Model
{
    use HasFactory;

    protected $table = 'programstudi';
    protected $primaryKey = 'id_prodi';

    protected $fillable = [
        'id_prodi',
        'nama_prodi',
    ];
}
