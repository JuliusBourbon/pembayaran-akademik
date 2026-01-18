<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = true; 
    protected $keyType = 'int';
    public $timestamps = false;
    protected $guarded = [];

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    // protected $hidden = [
    //     'password',
    // ];
}
