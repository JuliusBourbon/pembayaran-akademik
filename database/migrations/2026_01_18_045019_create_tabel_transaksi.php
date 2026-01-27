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
                tgl_bayar DATETIME,
                no_reg VARCHAR(20) NOT NULL,
                id_petugas BIGINT UNSIGNED,
                total_bayar INT,
                PRIMARY KEY (no_transaksi),
                CONSTRAINT fk_trx_mahasiswa FOREIGN KEY (no_reg) REFERENCES mahasiswa(no_reg),
                CONSTRAINT fk_trx_users FOREIGN KEY (id_petugas) REFERENCES petugas(id)
            )
        ");

        DB::statement("
            CREATE TABLE transaksi_detail (
                id_detail BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                no_transaksi VARCHAR(20),
                jenis_biaya VARCHAR(50),
                nominal INT,
                CONSTRAINT fk_detail_header FOREIGN KEY (no_transaksi) REFERENCES transaksi(no_transaksi) ON DELETE CASCADE
            )
        ");

    
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_bayar_registrasi;
            
            CREATE PROCEDURE sp_bayar_registrasi(
                IN p_no_reg VARCHAR(20),
                IN p_petugas VARCHAR(255),
                IN p_nominal INT
            )
            BEGIN
                DECLARE v_kode_trx VARCHAR(20);
                DECLARE v_kode_prodi VARCHAR(5);
                DECLARE v_angka_prodi VARCHAR(2);
                DECLARE v_tahun VARCHAR(2);
                DECLARE v_urut INT;
                DECLARE v_nim_baru VARCHAR(15);
                DECLARE v_nama_mhs VARCHAR(100);
                DECLARE v_nama_depan VARCHAR(50);
                DECLARE v_username_baru VARCHAR(50);
                DECLARE v_pass_raw VARCHAR(20); -- Variabel untuk password mentah
                DECLARE v_email_baru VARCHAR(100);
                DECLARE v_total_bayar_akumulasi INT;

         
                SET v_kode_trx = CONCAT('TRX-', DATE_FORMAT(NOW(), '%Y%m%d'), '-', FLOOR(RAND()*(999-100)+100));
                
                INSERT INTO transaksi (no_transaksi, tgl_bayar, no_reg, id_petugas, total_bayar)
                VALUES (v_kode_trx, NOW(), p_no_reg, p_petugas, p_nominal);

                INSERT INTO transaksi_detail (no_transaksi, jenis_biaya, nominal)
                VALUES (v_kode_trx, 'Pembayaran Kuliah', p_nominal);

 
                SELECT SUM(total_bayar) INTO v_total_bayar_akumulasi 
                FROM transaksi WHERE no_reg = p_no_reg;

      
                IF v_total_bayar_akumulasi >= 19000000 THEN
                    
                    SELECT kode_prodi, nama_mhs INTO v_kode_prodi, v_nama_mhs 
                    FROM mahasiswa WHERE no_reg = p_no_reg;

             
                    IF v_kode_prodi = 'IF' THEN SET v_angka_prodi = '10';
                    ELSEIF v_kode_prodi = 'DKV' THEN SET v_angka_prodi = '20';
                    ELSEIF v_kode_prodi = 'TI' THEN SET v_angka_prodi = '30';
                    ELSEIF v_kode_prodi = 'SI' THEN SET v_angka_prodi = '40';
                    ELSE SET v_angka_prodi = '99';
                    END IF;
                    
                    SET v_tahun = DATE_FORMAT(NOW(), '%y');
                    SELECT COUNT(*) + 1 INTO v_urut FROM mahasiswa WHERE nim LIKE CONCAT(v_angka_prodi, v_tahun, '%');
                    SET v_nim_baru = CONCAT(v_angka_prodi, v_tahun, LPAD(v_urut, 3, '0'));
                    
                   
                    SET v_username_baru = FLOOR(100000 + (RAND() * 899999));
                    
             
                    SET v_pass_raw = FLOOR(10000000 + (RAND() * 89999999));
                    
            
                    SET v_nama_depan = LOWER(SUBSTRING_INDEX(v_nama_mhs, ' ', 1));
                    SET v_nama_depan = REGEXP_REPLACE(v_nama_depan, '[^a-z0-9]', ''); 
                    SET v_email_baru = CONCAT(v_nama_depan, '.', v_nim_baru, '@mahasiswa.unikom.ac.id');

            
                    UPDATE mahasiswa 
                    SET 
                        nim = v_nim_baru,
                        username = v_username_baru,
                        password = v_pass_raw, 
                        email_kampus = v_email_baru
                    WHERE no_reg = p_no_reg;
                END IF;
            END
        ");
    }

    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_bayar_registrasi");
        DB::statement("DROP TABLE IF EXISTS transaksi_detail");
        DB::statement("DROP TABLE IF EXISTS transaksi");
    }
};