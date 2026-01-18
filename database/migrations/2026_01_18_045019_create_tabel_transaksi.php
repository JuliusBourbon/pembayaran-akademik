<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE TABLE transaksi (
                no_transaksi VARCHAR(20) NOT NULL,
                tgl_bayar DATE,
                waktu_bayar TIME,
                nim VARCHAR(15),
                id_petugas CHAR(5),
                PRIMARY KEY (no_transaksi),
                CONSTRAINT fk_transaksi_mahasiswa FOREIGN KEY (nim) REFERENCES mahasiswa(nim),
                CONSTRAINT fk_transaksi_petugas FOREIGN KEY (id_petugas) REFERENCES petugas(id_petugas)
            )
        ");
    }

    public function down()
    {
        DB::statement("DROP TABLE IF EXISTS transaksi");
    }
};