<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE TABLE transaksi (
                no_transaksi VARCHAR(30) NOT NULL,
                tgl_bayar DATETIME,
                no_reg VARCHAR(20) NOT NULL,
                id_petugas BIGINT UNSIGNED,
                total_bayar INT,
                PRIMARY KEY (no_transaksi),
                CONSTRAINT fk_trx_mahasiswa FOREIGN KEY (no_reg) REFERENCES mahasiswa(no_reg),
                CONSTRAINT fk_trx_petugas FOREIGN KEY (id_petugas) REFERENCES petugas(id) 
            )
        ");

        DB::statement("
            CREATE TABLE transaksi_detail (
                id_detail BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                no_transaksi VARCHAR(30),
                jenis_biaya VARCHAR(100),
                nominal INT,
                CONSTRAINT fk_detail_header FOREIGN KEY (no_transaksi) REFERENCES transaksi(no_transaksi) ON DELETE CASCADE
            )
        ");
    }

    public function down()
    {
        DB::statement("DROP TABLE IF EXISTS transaksi_detail");
        DB::statement("DROP TABLE IF EXISTS transaksi");
    }
};