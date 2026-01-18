<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE TABLE petugas (
                id_petugas CHAR(5) NOT NULL,
                nama_petugas VARCHAR(50),
                jabatan VARCHAR(30),
                cabang VARCHAR(50),
                PRIMARY KEY (id_petugas)
            )
        ");
    }

    public function down()
    {
        DB::statement("DROP TABLE IF EXISTS petugas");
    }
};