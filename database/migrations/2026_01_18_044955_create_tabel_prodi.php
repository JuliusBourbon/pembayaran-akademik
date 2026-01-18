<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE TABLE prodi (
                kode_prodi VARCHAR(5) NOT NULL,
                nama_prodi VARCHAR(50),
                fakultas VARCHAR(50),
                PRIMARY KEY (kode_prodi)
            )
        ");
    }

    public function down()
    {
        DB::statement("DROP TABLE IF EXISTS prodi");
    }
};