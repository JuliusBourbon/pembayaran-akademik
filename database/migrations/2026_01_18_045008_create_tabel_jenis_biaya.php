<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE TABLE jenis_biaya (
                id_jenis_biaya CHAR(3) NOT NULL,
                nama_biaya VARCHAR(50),
                nominal INT,
                PRIMARY KEY (id_jenis_biaya)
            )
        ");
    }

    public function down()
    {
        DB::statement("DROP TABLE IF EXISTS jenis_biaya");
    }
};