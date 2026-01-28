<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(){
        if (!Session::has('is_logged_in')) {
            return redirect('/login');
        }

        // Hitung total mahasiswa
        $totalMhs = DB::select("SELECT COUNT(*) as total FROM mahasiswa")[0]->total;

        // Hitung total pendapatan (Handle jika null)
        $totalUang = DB::select("SELECT SUM(total_bayar) as total FROM transaksi")[0]->total ?? 0;

        // Hitung transaksi hari ini
        $trxHariIni = DB::select("
            SELECT COUNT(*) as total 
            FROM transaksi 
            WHERE DATE(tgl_bayar) = CURDATE()
        ")[0]->total;

        // Hitung Mahasiswa Lunas (Subquery: Cari yang total bayarnya >= 19.5 Juta)
        $mhsLunas = DB::select("
            SELECT COUNT(*) as total FROM (
                SELECT no_reg 
                FROM transaksi 
                GROUP BY no_reg 
                HAVING SUM(total_bayar) >= 19500000
            ) as subquery
        ")[0]->total;


        // 2. DATA GRAFIK/LIST: Sebaran Mahasiswa per Prodi
        $statProdi = DB::select("
            SELECT 
                m.kode_prodi, 
                p.nama_prodi, 
                COUNT(*) as total 
            FROM mahasiswa m
            JOIN prodi p ON m.kode_prodi = p.kode_prodi
            GROUP BY m.kode_prodi, p.nama_prodi 
            ORDER BY total DESC
        ");


        // 3. TABEL: 5 Transaksi Terakhir (Join dengan mahasiswa & petugas)
        $transaksiTerbaru = DB::select("
            SELECT 
                t.no_transaksi,
                t.tgl_bayar,
                t.total_bayar,
                m.nama_mhs,
                m.kode_prodi,
                p.username as nama_petugas
            FROM transaksi t
            JOIN mahasiswa m ON t.no_reg = m.no_reg
            LEFT JOIN petugas p ON t.id_petugas = p.id
            ORDER BY t.tgl_bayar DESC
            LIMIT 10
        ");

        return view('dashboard', compact(
            'totalMhs', 
            'totalUang', 
            'trxHariIni', 
            'mhsLunas',
            'statProdi',
            'transaksiTerbaru'
        ));
    }
}
