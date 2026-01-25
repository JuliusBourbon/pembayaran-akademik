<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE TABLE mahasiswa (
                no_reg VARCHAR(20) NOT NULL,   
                nim VARCHAR(15) NULL,    
                nama_mhs VARCHAR(100),
                alamat VARCHAR(255),
                telepon VARCHAR(15),
                tlp_ortu VARCHAR(15),
                email_kampus VARCHAR(100) NULL, 
                username VARCHAR(50),
                password VARCHAR(255),         
                virtual_account VARCHAR(20),
                kode_prodi VARCHAR(5),
                
                PRIMARY KEY (no_reg),          
                UNIQUE (nim, virtual_account),                  
                CONSTRAINT fk_mahasiswa_prodi FOREIGN KEY (kode_prodi) REFERENCES prodi(kode_prodi)
            )
        ");
    }

    public function down()
    {
        DB::statement("DROP TABLE IF EXISTS mahasiswa");
    }
};