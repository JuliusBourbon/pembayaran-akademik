<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE TABLE mahasiswa (
                nim VARCHAR(15) NOT NULL,
                no_reg VARCHAR(20),
                nama_mhs VARCHAR(100),
                alamat VARCHAR(255),
                telepon VARCHAR(15),
                tlp_ortu VARCHAR(15),
                email_kampus VARCHAR(100),
                username VARCHAR(50),
                password VARCHAR(50),
                virtual_account VARCHAR(20),
                kode_prodi VARCHAR(5),
                PRIMARY KEY (nim),
                CONSTRAINT fk_mahasiswa_prodi FOREIGN KEY (kode_prodi) REFERENCES prodi(kode_prodi)
            )
        ");
    }

    public function down()
    {
        DB::statement("DROP TABLE IF EXISTS mahasiswa");
    }
};