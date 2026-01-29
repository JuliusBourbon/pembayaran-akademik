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

        $totalMhs = DB::select("SELECT COUNT(*) as total FROM mahasiswa")[0]->total;

        $totalUang = DB::select("SELECT SUM(total_bayar) as total FROM transaksi")[0]->total ?? 0;

        $trxHariIni = DB::select("
            SELECT COUNT(*) as total 
            FROM transaksi 
            WHERE DATE(tgl_bayar) = CURDATE()
        ")[0]->total;

        $mhsLunas = DB::select("
            SELECT COUNT(*) as total FROM (
                SELECT no_reg 
                FROM transaksi 
                GROUP BY no_reg 
                HAVING SUM(total_bayar) >= 19500000
            ) as subquery
        ")[0]->total;


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

    public function history(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');
        $query = "
            SELECT 
                t.no_transaksi,
                t.kode_transaksi,
                t.tgl_bayar,
                t.total_bayar,
                m.nama_mhs,
                m.kode_prodi,
                p.username as nama_petugas
            FROM transaksi t
            JOIN mahasiswa m ON t.no_reg = m.no_reg
            LEFT JOIN petugas p ON t.id_petugas = p.id
            WHERE 1=1
        ";
        $bindings = [];
        if ($startDate) {
            $query .= " AND DATE(t.tgl_bayar) >= ?";
            $bindings[] = $startDate;
        }
        if ($endDate) {
            $query .= " AND DATE(t.tgl_bayar) <= ?";
            $bindings[] = $endDate;
        }
        $query .= " ORDER BY t.tgl_bayar DESC";

        $transaksi = DB::select($query, $bindings);

        $totalPemasukan = 0;
        foreach ($transaksi as $trx) {
            $totalPemasukan += $trx->total_bayar;
        }

        return view('riwayat_transaksi', compact('transaksi', 'startDate', 'endDate', 'totalPemasukan'));
    }
}
