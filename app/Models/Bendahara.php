<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bendahara extends Model
{
    use HasFactory;

    protected $table = 'bendahara';
    protected $primaryKey = 'nip';

    protected $fillable = [
        'nip',
        'nama',
        'alamat',
        'telepon',
        'email',
    ];
}
