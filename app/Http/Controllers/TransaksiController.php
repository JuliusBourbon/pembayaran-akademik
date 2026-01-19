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
        $request->validate([
            'no_reg'  => 'required',
            'nominal' => 'required|numeric|min:100000'
        ]);

        $no_reg = $request->input('no_reg');
        $nominal = $request->input('nominal');
        
        $petugas = Session::get('username'); 

        try {
        
            DB::statement("CALL sp_bayar_registrasi(?, ?, ?)", [
                $no_reg, 
                $petugas, 
                $nominal
            ]);

        
            $cek_mhs = DB::select("SELECT nim, nama_mhs FROM mahasiswa WHERE no_reg = ?", [$no_reg]);
            $nim_baru = $cek_mhs[0]->nim;

            if ($nim_baru) {
               
                $pesan = "TRANSAKSI SUKSES! Mahasiswa a.n {$cek_mhs[0]->nama_mhs} resmi aktif dengan NIM: $nim_baru";
            } else {
                
                $pesan = "Pembayaran Angsuran Berhasil disimpan (Status: Belum Lunas/Belum dapat NIM).";
            }

            return redirect('/cari-mahasiswa?q='.$no_reg)->with('success', $pesan);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }
}