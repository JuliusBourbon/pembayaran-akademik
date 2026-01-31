<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1. VIEW: Rekap Pembayaran Mahasiswa
        DB::unprepared("
            DROP VIEW IF EXISTS v_rekap_pembayaran;
            CREATE VIEW v_rekap_pembayaran AS
            SELECT 
                m.no_reg,
                m.nama_mhs,
                m.nim,
                p.nama_prodi,
                COALESCE(SUM(t.total_bayar), 0) as total_dibayar,
                CASE 
                    WHEN COALESCE(SUM(t.total_bayar), 0) >= 19500000 THEN 'Lunas' 
                    ELSE 'Belum Lunas'
                END as status_bayar
            FROM mahasiswa m
            LEFT JOIN prodi p ON m.kode_prodi = p.kode_prodi
            LEFT JOIN transaksi t ON m.no_reg = t.no_reg
            GROUP BY m.no_reg, m.nama_mhs, m.nim, p.nama_prodi;
        ");

        // 2. FUNCTION: Hitung Sisa Tagihan
        DB::unprepared("
            DROP FUNCTION IF EXISTS fn_hitung_sisa_tagihan;
            CREATE FUNCTION fn_hitung_sisa_tagihan(reg_no VARCHAR(20)) 
            RETURNS INT
            DETERMINISTIC
            BEGIN
                DECLARE v_total_bayar INT;
                DECLARE v_wajib_bayar INT DEFAULT 19500000; -- Sesuaikan total biaya
                DECLARE v_sisa INT;

                SELECT COALESCE(SUM(total_bayar), 0) INTO v_total_bayar 
                FROM transaksi 
                WHERE no_reg = reg_no;

                SET v_sisa = v_wajib_bayar - v_total_bayar;
                
                IF v_sisa < 0 THEN
                    RETURN 0;
                END IF;

                RETURN v_sisa;
            END
        ");

        // 3. TRIGGER: Log Aktivitas
        DB::statement("
            CREATE TABLE IF NOT EXISTS log_aktivitas (
                id_log INT AUTO_INCREMENT PRIMARY KEY,
                pesan VARCHAR(255),
                waktu DATETIME
            )
        ");

        DB::unprepared("
            DROP TRIGGER IF EXISTS trg_after_transaksi;
            CREATE TRIGGER trg_after_transaksi
            AFTER INSERT ON transaksi
            FOR EACH ROW
            BEGIN
                INSERT INTO log_aktivitas (pesan, waktu)
                VALUES (CONCAT('Pembayaran masuk: ', NEW.no_transaksi, ' sebesar Rp ', NEW.total_bayar), NOW());
            END
        ");
        
        // 4. PROCEDURE: Update Kontak
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_update_kontak_mhs;
            CREATE PROCEDURE sp_update_kontak_mhs(
                IN p_no_reg VARCHAR(20),
                IN p_alamat VARCHAR(255),
                IN p_telepon VARCHAR(15)
            )
            BEGIN
                UPDATE mahasiswa 
                SET alamat = p_alamat, telepon = p_telepon 
                WHERE no_reg = p_no_reg;
            END
        ");

        // 5. PROCEDURE: Update Mahasiswa Full 
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_update_mahasiswa_full;
            CREATE PROCEDURE sp_update_mahasiswa_full(
                IN p_no_reg VARCHAR(20),
                IN p_nama VARCHAR(100),
                IN p_alamat VARCHAR(255),
                IN p_telepon VARCHAR(15),
                IN p_tlp_ortu VARCHAR(15),
                IN p_kode_prodi VARCHAR(5),
                IN p_password VARCHAR(255)
            )
            BEGIN
                UPDATE mahasiswa 
                SET 
                    nama_mhs = p_nama,
                    alamat = p_alamat,
                    telepon = p_telepon,
                    tlp_ortu = p_tlp_ortu,
                    kode_prodi = p_kode_prodi,
                    password = IFNULL(p_password, password) 
                WHERE no_reg = p_no_reg;
            END
        ");
    }

    public function down()
    {
        DB::unprepared("DROP VIEW IF EXISTS v_rekap_pembayaran");
        DB::unprepared("DROP FUNCTION IF EXISTS fn_hitung_sisa_tagihan");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_after_transaksi");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_update_kontak_mhs");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_update_mahasiswa_full");
        DB::statement("DROP TABLE IF EXISTS log_aktivitas");
    }
};