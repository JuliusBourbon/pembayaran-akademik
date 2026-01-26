<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    public function create($no_reg)
    {
        if (!Session::has('is_logged_in')) {
            return redirect('/login');
        }

        $mahasiswa = DB::select("
            SELECT m.*, p.nama_prodi 
            FROM mahasiswa m 
            LEFT JOIN prodi p ON m.kode_prodi = p.kode_prodi
            WHERE m.no_reg = ?
        ", [$no_reg]);

        if (empty($mahasiswa)) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        if ($mahasiswa[0]->nim != null) {
            return back()->with('error', 'Mahasiswa ini sudah lunas dan memiliki NIM.');
        }

        return view('transaksi_input', ['mhs' => $mahasiswa[0]]);
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'no_reg' => 'required',
            'opsi_kuliah' => 'required|in:lunas,angsur',
            'angsuran.*' => 'numeric|min:0'
        ]);

        $no_reg = $request->input('no_reg');
        $petugas = Session::get('username'); 

        // 2. Hitung Total Pembayaran
        // Ambil nilai BPP dan Penunjang
        $bpp = (int) str_replace('.', '', $request->input('bpp', 0));
        $penunjang = (int) str_replace('.', '', $request->input('penunjang', 0));
        
        // Hitung Biaya Kuliah
        $biaya_kuliah = 0;
        
        if ($request->input('opsi_kuliah') == 'lunas') {
            // ATURAN BARU: Jika Lunas Sekaligus = Rp 8.500.000
            $biaya_kuliah = 8500000; 
        } else {
            // ATURAN BARU: Jika Angsuran = Total Rp 9.000.000 (Dihitung dari input yang dibayar saat ini)
            if ($request->has('angsuran')) {
                foreach ($request->angsuran as $jml) {
                    $biaya_kuliah += (int) str_replace('.', '', $jml);
                }
            }
        }

        // Total Nominal yang akan masuk ke Database
        $total_nominal = $bpp + $penunjang + $biaya_kuliah;

        if ($total_nominal <= 0) {
            return back()->with('error', 'Nominal pembayaran tidak boleh 0.');
        }

        try {
            // 3. Panggil Stored Procedure
            DB::statement("CALL sp_bayar_registrasi(?, ?, ?)", [
                $no_reg, 
                $petugas, 
                $total_nominal
            ]);

            // 4. Cek Hasil (Apakah NIM terbentuk?)
            $cek_mhs = DB::select("SELECT nim, nama_mhs FROM mahasiswa WHERE no_reg = ?", [$no_reg]);
            $nim_baru = $cek_mhs[0]->nim;

            if ($nim_baru) {
                $pesan = "TRANSAKSI LUNAS! Mahasiswa a.n {$cek_mhs[0]->nama_mhs} resmi aktif dengan NIM: $nim_baru";
            } else {
                $pesan = "Pembayaran Angsuran Berhasil disimpan (Total Bayar: Rp " . number_format($total_nominal, 0, ',', '.') . "). Status: Belum Lunas.";
            }

            return redirect('/cari-mahasiswa?q='.$no_reg)->with('success', $pesan);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }

    public function cetak($no_transaksi)
    {
        if (!Session::has('is_logged_in')) {
            return redirect('/login');
        }

    
        $transaksi = \App\Models\Transaksi::with(['details', 'mahasiswa', 'petugas'])
            ->where('no_transaksi', $no_transaksi)
            ->first();

        if (!$transaksi) {
            return back()->with('error', 'Data transaksi tidak ditemukan.');
        }

        return view('struk_pembayaran', ['trx' => $transaksi]);
    }
}