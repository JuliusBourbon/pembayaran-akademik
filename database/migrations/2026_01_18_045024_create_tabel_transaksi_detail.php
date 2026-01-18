<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE TABLE transaksi_detail (
                id_detail BIGINT NOT NULL AUTO_INCREMENT,
                no_transaksi VARCHAR(20),
                id_jenis_biaya CHAR(3),
                keterangan VARCHAR(50),
                nominal BIGINT,
                PRIMARY KEY (id_detail),
                CONSTRAINT fk_detail_transaksi FOREIGN KEY (no_transaksi) REFERENCES transaksi(no_transaksi),
                CONSTRAINT fk_detail_jenis FOREIGN KEY (id_jenis_biaya) REFERENCES jenis_biaya(id_jenis_biaya)
            )
        ");
    }

    public function down()
    {
        DB::statement("DROP TABLE IF EXISTS transaksi_detail");
    }
};